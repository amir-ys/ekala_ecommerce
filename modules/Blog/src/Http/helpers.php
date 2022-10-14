<?php
if (!function_exists('getMostVisitedPostsFromRedis')) {
    function getMostVisitedPostsFromRedis(): array
    {
        return visits(\Modules\Blog\Models\Post::class)
            ->top()
            ->where('status' , \Modules\Blog\Models\Post::STATUS_ACTIVE)
            ->take(6)
            ->all();
    }

   if (!function_exists('postVisitCount')){
       function postVisitCount($postId)
       {
           $model = resolve(\Modules\Product\Contracts\ProductRepositoryInterface::class)->findById($postId);
           return $model->vzt()->count();
       }
   }
}
