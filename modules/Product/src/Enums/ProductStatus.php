<?php
namespace Modules\Product\Enums;

use Illuminate\Support\Traits\EnumeratesValues;

Enum ProductStatus :int
{
    case ACTIVE = 1;
    case INACTIVE = 0;
}
