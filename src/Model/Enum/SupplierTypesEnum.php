<?php
declare(strict_types=1);

namespace App\Model\Enum;

abstract class SupplierTypesEnum extends Base\BaseEnum {
    // const __default = self::Ativo;

    const Sementes = 1;
    const Quimicos = 2;
    const Adubos = 3;
}