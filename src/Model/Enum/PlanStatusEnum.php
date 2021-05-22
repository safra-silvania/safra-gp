<?php
declare(strict_types=1);

namespace App\Model\Enum;

abstract class PlanStatusEnum extends Base\BaseEnum {
    const __default = self::Vigente;

    const Vigente = 1;
    const Finalizado = 2;
}