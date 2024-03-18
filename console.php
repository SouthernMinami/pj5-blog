<?php
spl_autoload_extensions(".php");
spl_autoload_register(function ($class) {
    $namespace = explode('\\', $class);
    $file = __DIR__ . '/' . implode('/', $namespace) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

$commands = include "Commands/registry.php";
// 第２引数（実際に実行するコマンド）
$inputCommand = $argv[1];

foreach ($commands as $commandClass) {
    $alias = $commandClass::getAlias();

    if ($inputCommand === $alias) {
        if ($in_array('--help', $argv)) {
            fwrite(STDOUT, $commandClass::getHelp());
            exit (0);
        } else {
            $command = new $commandClass();
            $result = $command->execute();
            exit ($result);
        }
    }
}

fwrite(STDOUT, "コマンドを実行できませんでした。" . PHP_EOL);
