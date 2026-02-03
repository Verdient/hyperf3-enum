<?php

declare(strict_types=1);

namespace Verdient\Hyperf3\Enum;

use UnitEnum;

/**
 * 包含标签
 *
 * @author Verdient。
 */
trait HasLabel
{
    /**
     * 获取标签
     *
     * @param array $replaces 用于替换的参数
     * @param string|UnitEnum|null|false $locale 语言
     *
     * @author Verdient。
     */
    public function label(array $replaces = [], string|UnitEnum|null|false $locale = null): string
    {
        return LabelManager::label($this, $replaces, $locale);
    }

    /**
     * 获取标签
     *
     * @param string|int|float $value 待获取的值
     *
     * @author Verdient。
     */
    public static function getLabel(string|int|float $value): ?string
    {
        return static::tryFrom($value)?->label();
    }
}
