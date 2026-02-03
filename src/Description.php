<?php

declare(strict_types=1);

namespace Verdient\Hyperf3\Enum;

use Attribute;

/**
 * 描述
 *
 * @author Verdient。
 */
#[Attribute(Attribute::TARGET_CLASS)]
class Description
{
    /**
     * @param string $content 描述内容
     *
     * @author Verdient。
     */
    public function __construct(
        public readonly string $content
    ) {}
}
