<?php

namespace Helpers;

use Database\MySQLWrapper;
use Exception;

class DatabaseHelper
{
    public static function getRandomComputerPart(): array
    {
        $db = new MySQLWrapper();

        $stmt = $db->prepare("SELECT * FROM computer_parts ORDER BY RAND() LIMIT 1");
        $stmt->execute();
        $result = $stmt->get_result();
        $part = $result->fetch_assoc();

        if (!$part)
            throw new Exception('Could not find a single part in database');

        return $part;
    }

    public static function getComputerPartById(int $id): array
    {
        $db = new MySQLWrapper();

        $stmt = $db->prepare("SELECT * FROM computer_parts WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $part = $result->fetch_assoc();

        if (!$part)
            throw new Exception('Could not find a single part in database');

        return $part;
    }

    public static function getComputerPartsByType(string $type, int $page, int $perpage): array
    {
        $db = new MySQLWrapper();

        // ページネーションのためのオフセットを計算
        $offset = ($page - 1) * $perpage;
        
        $stmt = $db->prepare("SELECT * FROM computer_parts WHERE type = ? LIMIT ?, ?");
        $stmt->bind_param('sii', $type, $offset, $perpage);
        $stmt->execute();

        $result = $stmt->get_result();
        $parts = $result->fetch_all(MYSQLI_ASSOC);

        if (!$parts)
            throw new Exception('Could not find any parts in database');

        return $parts;
    }
}
