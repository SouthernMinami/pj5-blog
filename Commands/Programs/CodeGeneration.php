<?php

// コード生成のコマンド

namespace Commands\Programs;

use Commands\AbstractCommand;
use Commands\Argument;

class CodeGeneration extends AbstractCommand
{
    // 使用するコマンド名
    protected static ?string $alias = 'code-gen';
    protected static bool $requiredCommandValue = true;

    // 引数の割当
    public static function getArgs(): array
    {
        return [(new Argument('command'))->description('生成するコードの種類を入力してください。')->required(false)];
    }

    public function execute(): int
    {
        $codeGenType = $this->getCommandValue();

        switch ($codeGenType) {
            case 'command':
                $this->generateCommand(readline("コマンド名を入力してください: "));
                break;
            default:
                $this->log('Invalid code generation type.');
                break;
        }
        return 0;
    }

    // 新しいコマンドファイルを生成してProgramsに追加する関数
    public function generateCommand(string $name): void
    {
        $capitalized_name = ucfirst($name);
        // 空白区切りで引数を取得
        $args = explode(' ', readline("コマンドで利用するオプションをスペース区切りで入力してください:"));
        $exec_code = readline("コマンドの実行コードを入力してください: ");

        $file_path = "Commands/Programs/" . $capitalized_name . ".php";
        $content = "<?php
            namespace Commands\Programs;
            
            use Commands\AbstractCommand;
            use Commands\Argument;

            class $capitalized_name extends AbstractCommand
            {
                protected static ?string \$alias = '$name';

                public static function getArgs(): array
                {

                    return [
                        " . implode(",\n", array_map(function ($arg) {
            return "(new Argument('$arg'))->description('')->required(false)->allowAsShort(true)";
        }, $args)) . "
                    ];
                }

                public function execute(): int
                {
                    $exec_code
                    return 0;
                }
            }
        ";

        file_put_contents($file_path, $content);
        // registry.phpに新しいコマンドを追加
        $registry_path = "Commands/registry.php";
        $registry_content = file_get_contents($registry_path);
        $registry_content = str_replace("return [", "return [\n    Commands\Programs\\$capitalized_name::class,", $registry_content);
        file_put_contents($registry_path, $registry_content);
    }
}
