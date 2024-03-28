<?php

namespace Commands\Programs;

use Commands\AbstractCommand;
use Commands\Argument;
use Database\MySQLWrapper;

class BookSearch extends AbstractCommand
{
    protected static ?string $alias = 'booksearch';
    protected static array $cache = [];
    protected MySQLWrapper $result = new MySQLWrapper();

    public static function getArgs(): array
    {
        return [
            (new Argument('title'))->description('本のタイトルを入力してください。')->required(true)->allowAsShort(true),
            (new Argument('isbn'))->description('ISBNを入力してください。')->required(true)->allowAsShort(true),
        ];
    }

    public function execute(): int
    {
        $title = $this->getArgValue('title');
        $isbn = $this->getArgValue('isbn');

        if ($title) {
            $this->searchByTitle($title);
        } else if ($isbn) {
            $this->searchByISBN($isbn);
        }
        return 0;
    }

    public function searchByTitle(string $title): void
    {
        $cached_book = mysqli_fetch_assoc($this->result->query("SELECT * FROM books WHERE title = $title"));
        if ($cached_book) {
            $this->log(sprintf("この書籍のデータはすでにデータベースに存在します。%s", json_encode($cached_book)));
        } else {
            // book-search-title-???をキーとして、Open Libraryから取得したデータをキャッシュする

        }
    }

    public function searchByISBN(string $isbn): void
    {
        $this->log("ISBNで検索します。");
    }

}