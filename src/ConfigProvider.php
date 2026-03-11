<?php

declare(strict_types=1);

namespace Verdient\Hyperf3\Enum;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config for enum.',
                    'source' => dirname(__DIR__) . '/publish/enum.php',
                    'destination' => constant('BASE_PATH') . '/config/autoload/enum.php',
                ]
            ]
        ];
    }
}
