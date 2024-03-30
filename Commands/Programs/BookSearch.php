<?php

namespace Commands\Programs;

use Commands\AbstractCommand;
use Commands\Argument;
use Database\MySQLWrapper;

class BookSearch extends AbstractCommand
{
    protected static ?string $alias = 'booksearch';

    public static function getArgs(): array
    {
        return [
            (new Argument('title'))->description('本のタイトルを入力してください。')->required(false)->allowAsShort(true),
            (new Argument('isbn'))->description('ISBNを入力してください。')->required(false)->allowAsShort(true),
        ];
    }

    public function execute(): int
    {
        $title_opt = $this->getArgValue('title');
        $isbn_opt = $this->getArgValue('isbn');

        $mysqli = new MySQLWrapper();
        $query = "CREATE TABLE IF NOT EXISTS books (
            key_string varchar(255) PRIMARY KEY,
            title varchar(255) NOT NULL,
            author varchar(50) NOT NULL,
            publisher varchar(50) NOT NULL,
            isbn varchar(255) NOT NULL,
            pages int,
            created_at timestamp DEFAULT CURRENT_TIMESTAMP,
            updated_at timestamp DEFAULT CURRENT_TIMESTAMP
        )";
        $mysqli->query($query);
        $url = "https://openlibrary.org/search.json";

        if ($title_opt) {
            $title_input = readline("書籍のタイトルを入力してください: ");
            $url .= "?title=$title_input";
        } else if ($isbn_opt) {
            $isbn_input = readline("書籍のISBNを入力してください: ");
            $url .= "?isbn=$isbn_input";
        }
        $res = file_get_contents($url);
        $data = json_decode($res, true);

        $book_info = $data['docs'][0];
        $title = $mysqli->real_escape_string($book_info['title']);
        $key_string = "book-search-title-" . $title;
        $author = $mysqli->real_escape_string($book_info['author_name'][0]);
        $publisher = $mysqli->real_escape_string($book_info['publisher'][0]);
        $isbn = $mysqli->real_escape_string($book_info['isbn'][0]);
        $pages = intval($book_info['number_of_pages_median'][0]);

        $select_query = "SELECT * FROM books WHERE ";
        $select_query .= $title_opt ? "title = '" . $title . "'" : "isbn = '" . $isbn . "'";

        $result = $mysqli->query($select_query);
        // resultから1行取得
        $row = $result->fetch_assoc();
        var_dump($row);

        // DBに書籍情報がないか、30日以上経過していたらOpen Libraryから取得
        if (!$row || strtotime($row['updated_at']) < strtotime('-30 days')) {
            // Open Libraryから取得した検索結果の最初の書籍情報をDBに保存
            $insert_query = "INSERT INTO books (key_string, title, author, publisher, isbn, pages) VALUES (
                '{$key_string}',
                '{$title}',
                '{$author}',
                '{$publisher}',
                '{$isbn}',
                '{$pages}'
            )";

            $mysqli->query($insert_query);

            $this->log("書籍情報を取得しました。");
            $this->log("タイトル: " . $book_info['title']);

            $this->log("書籍情報をデータベースに保存しました。");
        } else {
            // 30日以上経過していたらデータベースの情報を更新
            $this->log("この書籍はデータベースに保存済みです。");
        }
        return 0;
    }
}