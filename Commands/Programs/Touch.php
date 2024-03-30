<?php
            namespace Commands\Programs;
            
            use Commands\AbstractCommand;
            use Commands\Argument;

            class Touch extends AbstractCommand
            {
                protected static ?string $alias = 'touch';

                public static function getArgs(): array
                {

                    return [
                        (new Argument(''))->description('')->required(false)->allowAsShort(true)
                    ];
                }

                public function execute(): int
                {
                    file_put_contents("new_file", "");
                    return 0;
                }
            }
        