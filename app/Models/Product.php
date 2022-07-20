<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';

    protected $fillable = ['id', 'name', 'price', 'deleted_at'];

    public function invoice_details()
    {
        return $this->hasMany('App\Models\InvoiceDetails', 'product_id');
    }
}
