<?php
namespace Database;

use Database\MySQLWrapper;

abstract class AbstractSeeder implements Seeder
{
    protected MySQLWrapper $conn;
    protected ?string $tableName = null;

    // テーブルカラムは、'data_type' と 'column_name' を含む連想配列の配列。
    protected array $tableColumns = [];

    // キーはデータ型の文字列で、値はbind_paramの文字列
    const AVAILABLE_TYPES = [
        'int' => 'i',
        // PHPのfloatはdouble型の精度
        'float' => 'd',
        'string' => 's',
    ];

    public function __construct(MySQLWrapper $conn)
    {
        $this->conn = $conn;
    }

    public function seed(): void
    {
        // データを作成
        $data = $this->createRowData();

        if ($this->tableName === null)
            throw new \Exception('Class requires a table name');
        if (empty($this->tableColumns))
            throw new \Exception('Class requires a columns');

        foreach ($data as $row) {
            // 行を検証
            $this->validateRow($row);
            $this->insertRow($row);
        }
    }

    // 各行をtableColumnsと照らし合わせて検証する関数
    protected function validateRow(array $row): void
    {
        if (count($row) !== count($this->tableColumns))
            throw new \Exception('Row does not match the ');

        foreach ($row as $i => $value) {
            $columnDataType = $this->tableColumns[$i]['data_type'];
            $columnName = $this->tableColumns[$i]['column_name'];

            if (!isset(static::AVAILABLE_TYPES[$columnDataType]))
                throw new \InvalidArgumentException(sprintf("The data type %s is not an available data type.", $columnDataType));

            // 値のデータタイプを返すget_debug_type()とgettype()がある
            // https://www.php.net/manual/en/function.get-debug-type.php 
            // get_debug_type ... ネイティブPHP8のタイプを返す。 (floatsのgettype()の場合は'float'ではなく、'double'を返す)
            if (get_debug_type($value) !== $columnDataType)
                throw new \InvalidArgumentException(sprintf("Value for %s should be of type %s. Here is the current value: %s", $columnName, $columnDataType, json_encode($value)));
        }
    }

    // 各行を挿入する関数
    protected function insertRow(array $row): void
    {
        // カラム名を取得
        $columnNames = array_map(function ($columnInfo) {
            return $columnInfo['column_name'];
        }, $this->tableColumns);

        // プレースホルダーの?はcount($row) - 1回繰り返され、最後の?の後にはカンマをつけない
        // そこにbind_paramで値を挿入する
        $placeholders = str_repeat('?,', count($row) - 1) . '?';

        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (%s)',
            $this->tableName,
            implode(', ', $columnNames),
            $placeholders
        );

        // prepare()はSQLステートメントを準備し、ステートメントオブジェクトを返す
        $stmt = $this->conn->prepare($sql);

        // データ型配列を結合して文字列にする
        $dataTypes = implode(array_map(function ($columnInfo) {
            return static::AVAILABLE_TYPES[$columnInfo['data_type']];
        }, $this->tableColumns));

        // 文字の配列（文字列）を取り、それぞれに行の値を挿入する
        // 例：$stmt->bind_param('iss', ...array_values([1, 'John', 'john@example.com'])) は、ステートメントに整数(i)、文字列(s)、文字列(s)を挿入する
        $row_values = array_values($row);
        $stmt->bind_param($dataTypes, ...$row_values);

        $stmt->execute();
    }
}