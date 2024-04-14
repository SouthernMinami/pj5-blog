<?php

use Helpers\DatabaseHelper;
use Helpers\ValidationHelper;
use Response\HTTPRenderer;
use Response\Render\HTMLRenderer;
use Response\Render\JSONRenderer;

return [
    'random/part' => function (): HTTPRenderer {
        $part = DatabaseHelper::getRandomComputerPart();

        return new HTMLRenderer('component/random-part', ['part' => $part]);
    },
    'parts' => function (): HTTPRenderer {
        // IDの検証
        $id = ValidationHelper::integer($_GET['id'] ?? null);

        $part = DatabaseHelper::getComputerPartById($id);
        return new HTMLRenderer('component/parts', ['part' => $part]);
    },
    'types' => function (): HTTPRenderer {
        $type = $_GET['type'] ?? null;
        $page = $_GET['page'] ?? 1;
        $perpage = $_GET['perpage'] ?? 3;

        $parts = DatabaseHelper::getComputerPartsByType($type, $page, $perpage);
        return new HTMLRenderer('component/parts-list', ['parts' => $parts]);
    },
    'api/random/part' => function (): HTTPRenderer {
        $part = DatabaseHelper::getRandomComputerPart();
        return new JSONRenderer(['part' => $part]);
    },
    'api/parts' => function () {
        $id = ValidationHelper::integer($_GET['id'] ?? null);
        $part = DatabaseHelper::getComputerPartById($id);
        return new JSONRenderer(['part' => $part]);
    },
    'api/types' => function () {
        $type = $_GET['type'] ?? null;
        $page = $_GET['page'] ?? 1;
        $perpage = $_GET['perpage'] ?? 3;

        $parts = DatabaseHelper::getComputerPartsByType($type, $page, $perpage);
        return new JSONRenderer(['parts' => $parts]);
    },
];
