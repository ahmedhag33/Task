<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    protected $table = 'invoice';

    protected $fillable = ['id', 'customer_id', 'invoice_no', 'invoice_data', 'deleted_at'];

    public function customers()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }
    public function invoice_details()
    {
        return $this->hasMany('App\Models\InvoiceDetails', 'invoice_id');
    }
}
