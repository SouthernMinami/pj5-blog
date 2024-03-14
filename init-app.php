<?php
use Database\MySQLWrapper;

spl_autoload_extensions(".php");
spl_autoload_register(function ($class) {
    $namespace = explode('\\', $class);
    $file = __DIR__ . '/' . implode('/', $namespace) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

$ops = getopt('', ['migrate']);
if (isset($ops['migrate'])) {
    printf('Database migration started' . PHP_EOL);
    include('Database/setup.php');
    printf('Database migration finished' . PHP_EOL);
}

$mysqli = new MySQLWrapper();
$charset = $mysqli->get_charset();
if ($charset === null)
    throw new Exception('Charsetがデータベースから読み取れませんでした。');

printf(
    "%s's charset: %s.%s",
    $mysqli->getDatabaseName(),
    $charset->charset,
    PHP_EOL
);

printf(
    "collation: %s.%s",
    $charset->collation,
    PHP_EOL
);

$mysqli->close();
