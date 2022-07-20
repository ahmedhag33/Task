<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $table = 'customers';

    protected $fillable = ['id', 'name', 'address', 'email', 'deleted_at'];

    public function invoice()
    {
        return $this->hasMany('App\Models\Invoice', 'customer_id');
    }
}
