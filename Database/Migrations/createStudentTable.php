<?php

namespace Database\Migrations;

use Database\MySQLWrapper;

$mysqli = new MySQLWrapper();

$createTableQuery = "
    CREATE TABLE students (
      id INT PRIMARY KEY AUTO_INCREMENT,
      name VARCHAR(100),
      age INT,
      major VARCHAR(50)
    )
";

$mysqli->query($createTableQuery);
