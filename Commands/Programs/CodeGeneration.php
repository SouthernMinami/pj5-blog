<?php

// コード生成のコマンド

namespace Commands\Programs;

use Commands\AbstractCommand;

class CodeGeneration extends AbstractCommand
{
    // 使用するコマンド名
    protected static ?string $alias = 'code-gen';
    protected static bool $requiredCommandValue = true;

    // 引数の割当
    public static function getArgs(): array
    {
        return [];
    }

    public function execute(): int
    {
        $codeGenType = $this->getCommandValue();
        $this->log('Generating code for.......' . $codeGenType);
        return 0;
    }
}
