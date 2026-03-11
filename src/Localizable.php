<?php

declare(strict_types=1);

namespace Verdient\Hyperf3\Enum;

use Hyperf\Di\Annotation\AbstractAnnotation;

use Attribute;

/**
 * 可本地化
 *
 * @author Verdient。
 */
#[Attribute(Attribute::TARGET_CLASS)]
class Localizable extends AbstractAnnotation {}
