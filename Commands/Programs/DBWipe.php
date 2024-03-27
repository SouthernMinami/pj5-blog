<?php

// DB全体をクリアするコマンド

namespace Commands\Programs;

use Commands\AbstractCommand;
use Commands\Argument;

class DBWipe extends AbstractCommand
{
    protected static ?string $alias = 'dbwipe';

    public static function getArgs(): array
    {
        return [
            (new Argument('dump'))->description('データベースをダンプし、ダンプファイルを作成します。')->required(false)->allowAsShort(true),
            (new Argument('restore'))->description('ダンプファイルからデータを復元します。')->required(false)->allowAsShort(true),
        ];
    }

    public function execute(): int
    {
        // ユーザー名を入力してください
        $username = readline('ユーザー名を入力してください: ');
        $dbname = readline('内容をクリアするデータベース名を入力してください: ');

        $dump = $this->getArgValue('dump');
        $restore = $this->getArgValue('restore');

        if ($dump) {
            $this->dump($username, $dbname);
        } else if ($restore) {
            $this->restore($username, $dbname);
            return 0;
        }
        $this->dbwipe($username, $dbname);
        return 0;
    }

    private function dbwipe(string $username, string $dbname): void
    {
        exec('mysql -u ' . $username . ' -p ' . $dbname . ' -e "DROP DATABASE IF EXISTS ' . $dbname . '; CREATE DATABASE ' . $dbname . ';"');
        $this->log(sprintf("データベース %s の内容がクリアされ、再作成されました。" . PHP_EOL, $dbname));
    }

    private function dump(string $username, string $dbname): void
    {
        exec('mysqldump -u ' . $username . ' -p ' . $dbname . ' > Database\Schema\backup.sql');
        $this->log(sprintf("データベース %s の内容からダンプファイルを作成しました。" . PHP_EOL, $dbname));
    }

    private function restore(string $username, string $dbname): void
    {
        exec('mysql -u ' . $username . ' -p ' . $dbname . ' < Database\Schema\backup.sql');
        $this->log(sprintf("データベース %s の内容をダンプファイルから復元しました。" . PHP_EOL, $dbname));
    }
}