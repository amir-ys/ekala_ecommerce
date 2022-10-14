<?php
if (!function_exists('getMostVisitedProductFromRedis')) {
    function getMostVisitedProductFromRedis($limit = 6): array
    {
        return visits(\Modules\Product\Models\Product::class)
            ->top()
            ->where('is_active', \Modules\Product\Enums\ProductStatus::ACTIVE)
            ->take($limit)
            ->all();
    }

    if (!function_exists('productVisitCount')) {
        function productVisitCount($productId)
        {
            $model = resolve(\Modules\Product\Contracts\ProductRepositoryInterface::class)->findById($productId);
            return $model->vzt()->count();
        }
    }
}
