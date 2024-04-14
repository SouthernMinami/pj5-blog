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

    public static function getRandomComputer(): array {
        $db = new MySQLWrapper();

        $parts = [
            'SELECT * FROM computer_parts WHERE type = "CPU" ORDER BY RAND() LIMIT 1',
            'SELECT * FROM computer_parts WHERE type = "GPU" ORDER BY RAND() LIMIT 1',              
            'SELECT * FROM computer_parts WHERE type = "SSD" ORDER BY RAND() LIMIT 1',
            'SELECT * FROM computer_parts WHERE type = "RAM" ORDER BY RAND() LIMIT 1',
            'SELECT * FROM computer_parts WHERE type = "Motherboard" ORDER BY RAND() LIMIT 1',
            'SELECT * FROM computer_parts WHERE type = "PSU" ORDER BY RAND() LIMIT 1',
            'SELECT * FROM computer_parts WHERE type = "Case" ORDER BY RAND() LIMIT 1'
        ];

        foreach ($parts as $key => $query) {
            $stmt = $db->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
            $part = $result->fetch_assoc();
            $parts[$key] = $part;
        }

        return $parts;
    }

    public static function getNewestComputerParts(int $page, int $perpage): array
    {
        $db = new MySQLWrapper();

        $offset = ($page - 1) * $perpage;

        // created_atで降順に並べ替え、ページネーションを適用
        $stmt = $db->prepare("SELECT * FROM computer_parts ORDER BY created_at DESC LIMIT ?, ?");
        $stmt->bind_param('ii', $offset, $perpage);
        $stmt->execute();

        $result = $stmt->get_result();
        $parts = $result->fetch_all(MYSQLI_ASSOC);

        if (!$parts)
            throw new Exception('Could not find any parts in database');

        return $parts;
    }
}
