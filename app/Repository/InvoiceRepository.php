<?php

namespace App\Repository;

use App\Models\Invoice;

class InvoiceRepository extends BaseRepository implements IInvoiceRepository
{
    public function __construct(Invoice $model)
    {
        parent::__construct($model);
    }
}
