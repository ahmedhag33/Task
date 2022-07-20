<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceDetails extends Model
{
    use SoftDeletes;

    protected $table = 'invoice_details';

    protected $fillable = ['id', 'product_id', 'invoice_id', 'quantity', 'subtotal', 'deleted_at'];

    public function invoice()
    {
        return $this->belongsTo('App\Models\Invoice', 'invoice_id');
    }
    public function products()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
