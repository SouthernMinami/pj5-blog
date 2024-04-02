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

echo "--------------------------------------" . PHP_EOL;
echo "データの更新" . PHP_EOL;

// データの更新（update）
$updates = [
    ['John', 'Philosophy'],
    ['Jane', 'Astronomy'],
    ['Doe', 'Geology'],
    ['Smith', 'Physics'],
    ['Brown', 'Computer Engineering'],
];

foreach ($updates as $update) {
    $update_query = "
        UPDATE students
        SET major = '{$update[1]}'
        WHERE name = '{$update[0]}'
    ";
    $mysqli->query($update_query);
}

$select_query = "SELECT * FROM students";
$result = $mysqli->query($select_query);

// 一行ずつ取得
while ($row = $result->fetch_assoc()) {
    echo "ID: " . $row['id'] . ", Name: " . $row['name'] . ", Age: " . $row['age'] . ", Major: " . $row['major'] . PHP_EOL;
}

echo "--------------------------------------" . PHP_EOL;
echo "データの削除" . PHP_EOL;

// データの削除（delete）
$students_to_delete = ['John', 'Jane'];

foreach ($students_to_delete as $student) {
    $delete_query = "
        DELETE FROM students
        WHERE name = '{$student}'";
    $mysqli->query($delete_query);
}

$select_query = "SELECT * FROM students";
$result = $mysqli->query($select_query);

// 一行ずつ取得
while ($row = $result->fetch_assoc()) {
    echo "ID: " . $row['id'] . ", Name: " . $row['name'] . ", Age: " . $row['age'] . ", Major: " . $row['major'] . PHP_EOL;
}