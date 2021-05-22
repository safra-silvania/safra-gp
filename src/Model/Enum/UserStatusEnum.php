<?php
declare(strict_types=1);

namespace App\Model\Enum;

abstract class UserStatusEnum extends Base\BaseEnum {
    const __default = self::Ativo;

    const Ativo = 1;
    const Inativo = 2;
}