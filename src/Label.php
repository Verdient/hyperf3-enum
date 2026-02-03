<?php

declare(strict_types=1);

namespace Verdient\Hyperf3\Enum;

use Attribute;

/**
 * 标签
 *
 * @author Verdient。
 */
#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
class Label
{
    /**
     * @param string $content 标签内容
     * @param ?string $i18nKey 国际化键
     *
     * @author Verdient。
     */
    public function __construct(
        public readonly string $content,
        public readonly ?string $i18nKey = null
    ) {}
}
