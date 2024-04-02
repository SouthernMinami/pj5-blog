<?php
spl_autoload_extensions(".php");
spl_autoload_register(function ($class) {
    $namespace = explode('\\', $class);
    $file = __DIR__ . '/' . implode('/', $namespace) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

use Database\MySQLWrapper;

$mysqli = new MySQLWrapper();

$charset = $mysqli->get_charset();
if ($charset === null)
    throw new Exception('Charset could be read');

$users_data = [
    ['admin', 'admin@example.com', '32u08fa9', 'admin'],
    ['user_1', 'user-1@example.com', 'jd9aewh3', 'user'],
    ['user_2', 'user-2@example.com', '9afeovz', 'user']
];


foreach ($users_data as $user) {
    $insert_query = "INSERT INTO test_users (username, email, password, role) VALUES ('$user[0]', '$user[1]', '$user[2]', '$user[3]')";
    $mysqli->query($insert_query);
}
