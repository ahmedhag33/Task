<?php

namespace App\Repository;

use App\Models\Product;

class ProductRepository extends BaseRepository implements IProductRepository
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }
}
