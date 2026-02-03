<?php

declare(strict_types=1);

namespace Verdient\Hyperf3\Enum;

use BackedEnum;
use Hyperf\Contract\TranslatorInterface;
use ReflectionClass;
use UnitEnum;
use Verdient\Hyperf3\Di\Container;

/**
 * 标签管理器
 *
 * @author Verdient。
 */
class LabelManager
{
    /**
     * 缓存的标签
     *
     * @author Verdient。
     */
    protected static array $labels = [];

    /**
     * 获取标签内容
     *
     * @param UnitEnum $enum 枚举对象
     *
     * @author Verdient。
     */
    public static function content(UnitEnum $enum): ?string
    {
        if (!$attribute = static::attribute($enum)) {
            return null;
        }

        return $attribute->content;
    }

    /**
     * 获取国际化键名
     *
     * @param UnitEnum $enum 枚举对象
     *
     * @author Verdient。
     */
    public static function i18nKey(UnitEnum $enum): string
    {
        if (!$attribute = static::attribute($enum)) {
            return str_replace('\\', '.', $enum::class) . '.' . $enum->name;
        }

        if (!$attribute->i18nKey) {
            return str_replace('\\', '.', $enum::class) . '.' . $enum->name;
        }

        return $attribute->i18nKey;
    }

    /**
     * 获取注解
     *
     * @param UnitEnum $enum 枚举对象
     *
     * @author Verdient。
     */
    public static function attribute(UnitEnum $enum): ?Label
    {
        $class = get_class($enum);

        $name = $enum->name;

        if (!isset(static::$labels[$class])) {
            static::$labels[$class] = [];
        }

        if (!array_key_exists($name, static::$labels[$class])) {

            $reflectionClass = new ReflectionClass($enum);

            $reflectionConstant = $reflectionClass->getReflectionConstant($name);

            if ($reflectionConstant) {
                $attributes = $reflectionConstant->getAttributes(Label::class);
                if (empty($attributes)) {
                    static::$labels[$class][$name] = null;
                } else {
                    /** @var Label */
                    $attribute = $attributes[0]->newInstance();
                    static::$labels[$class][$name] = $attribute;
                }
            } else {
                static::$labels[$class][$name] = null;
            }
        }

        return static::$labels[$class][$name];
    }

    /**
     * 获取标签
     *
     * @param UnitEnum $enum 枚举对象
     * @param array $replaces 用于替换的参数
     * @param string|UnitEnum|null|false $locale 语言
     *
     * @author Verdient。
     */
    public static function label(UnitEnum $enum, array $replaces = [], string|UnitEnum|null|false $locale = null): string
    {
        if ($locale !== false) {
            if ($translator = Container::getOrNull(TranslatorInterface::class)) {

                if ($locale instanceof BackedEnum) {
                    $locale = $locale->value;
                } else if ($locale instanceof UnitEnum) {
                    $locale = $locale->name;
                }

                $key = 'enum.' . static::i18nKey($enum);

                $value = $translator->trans($key, $replaces, $locale);

                if (is_string($value) && $value !== '' && $value !== $key) {
                    return $value;
                }
            }
        }

        return static::content($enum) ?: $enum->name;
    }
}
