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

$mysqli = new MySQLWrapper();

$createTableQuery = "
    CREATE TABLE IF NOT EXISTS students (
      id INT PRIMARY KEY AUTO_INCREMENT,
      name VARCHAR(100),
      age INT,
      major VARCHAR(50)
    )
";

$mysqli->query($createTableQuery);


// データの作成（create）
$students_data = [
    ['John', 18, 'Mathematics'],
    ['Jane', 19, 'Physics'],
    ['Doe', 20, 'Chemistry'],
    ['Smith', 21, 'Biology'],
    ['Brown', 22, 'Computer Science'],
];

foreach ($students_data as $student) {
    $insert_query = "
        INSERT INTO students (name, age, major)
        VALUES ('{$student[0]}', {$student[1]}, '{$student[2]}')
    ";
    $mysqli->query($insert_query);
}


// データの読み取り（read）   
$select_query = "SELECT * FROM students";
$result = $mysqli->query($select_query);

// 一行ずつ取得
while ($row = $result->fetch_assoc()) {
    echo "ID: " . $row['id'] . ", Name: " . $row['name'] . ", Age: " . $row['age'] . ", Major: " . $row['major'] . PHP_EOL;
}
