<?php

// コマンドを登録するためのレジストリ
// consoleはここから読み取る
return [
    Commands\Programs\Migrate::class,
    Commands\Programs\CodeGenreration::class,
];