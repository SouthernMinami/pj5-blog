<?php

// コマンドを登録するためのレジストリ
// consoleはここから読み取る
return [
    Commands\Programs\Touch::class,
    Commands\Programs\Migrate::class,
    Commands\Programs\CodeGeneration::class,
    Commands\Programs\DBWipe::class,
    Commands\Programs\BookSearch::class,
    Commands\Programs\StateMigrate::class,
    Commands\Programs\Seed::class,
];