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
        $title = $this->getArgValue('title');
        $isbn = $this->getArgValue('isbn');

        if ($title) {
            $title_input = readline("書籍のタイトルを入力してください: ");
            $this->searchByTitle($title_input);
        } else if ($isbn) {
            $isbn_input = readline("ISBNを入力してください: ");
            $this->searchByISBN($isbn_input);
        }
        return 0;
    }

    public function searchByTitle(string $title): void
    {
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

        $select_query = "SELECT * FROM books WHERE title = '$title'";
        $result = $mysqli->query($select_query);

        if ($result->num_rows === 0) {
            // Open Libraryから取得したデータをDBに保存
            $url = "https://openlibrary.org/search.json?title=$title";
            $res = file_get_contents($url);
            $data = json_decode($res, true);

            $book_info = $data['docs'][0];
            $title = $mysqli->real_escape_string($book_info['title']);
            $key_string = "book-search-title-" . $title;
            $author = $mysqli->real_escape_string($book_info['author_name'][0]);
            $publisher = $mysqli->real_escape_string($book_info['publisher'][0]);
            $isbn = $mysqli->real_escape_string($book_info['isbn'][0]);
            $pages = intval($book_info['number_of_pages_median'][0]);

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
            $this->log("この書籍はデータベースに保存済みです。");
            // while ($row = $result->fetch_assoc()) {
            //     $this->log("タイトル: " . $row['title']);
            //     $this->log("著者: " . $row['author']);
            //     $this->log("出版社: " . $row['publisher']);
            //     $this->log("ISBN: " . $row['isbn']);
            //     $this->log("ページ数: " . $row['pages']);
            //     $this->log("価格: " . $row['price']);
            // }
        }

    }

    public function searchByISBN(string $isbn): void
    {
        $this->log("ISBNで検索します。");
    }

}