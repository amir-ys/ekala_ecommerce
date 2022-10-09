<?php
if (!function_exists('getMostVisitedProductFromRedis')) {
    function getMostVisitedProductFromRedis(): array
    {
        return visits(\Modules\Product\Models\Product::class)
            ->top()
            ->where('is_active', \Modules\Product\Enums\ProductStatus::ACTIVE)
            ->take(6)
            ->all();
    }
}
