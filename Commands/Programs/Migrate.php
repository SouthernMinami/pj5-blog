<?php

// マイグレーションの実行、ロールバック、新しいスキーマインストールを行う
namespace Commands\Programs;

use Commands\AbstractCommand;
use Commands\Argument;

class Migrate extends AbstractCommand
{
    // 使用するコマンド名
    protected static ?string $alias = 'migrate';

    // 引数の割当
    public static function getArgs(): array
    {
        return [
            (new Argument('rollback'))->description('マイグレーションをロールバックします。ロールバック回数を指定することもできます。')->required(false)->allowAsShort(true),
        ];
    }

    public function execute(): int
    {
        $rollback = $this->getArgValue('rollback');
        if (!$rollback) {
            $this->log("マイグレーションを開始します。");
            $this->migrate();
        } else {
            $rollback = $rollback === true ? 1 : (int) $rollback;
            $this->log("マイグレーションをロールバックしています。");
            for ($i = 0; $i < $rollback; $i++) {
                $this->rollback();
            }
        }

        return 0;
    }

    private function migrate(): void
    {
        $this->log("Migrating...");
        $this->log("マイグレーションが完了しました。\n");
    }

    private function rollback(): void
    {
        $this->log("Rolling back...");
        $this->log("ロールバックが完了しました。\n");
    }
}