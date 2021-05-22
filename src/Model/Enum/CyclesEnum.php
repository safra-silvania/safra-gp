<?php
declare(strict_types=1);

namespace App\Model\Enum;

abstract class CyclesEnum extends Base\BaseEnum {
    const __default = self::Ativo;

    const Start = 30;
    const End = 90;
    const Max = 365;
}