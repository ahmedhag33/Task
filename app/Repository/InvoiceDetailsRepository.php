<?php

namespace App\Repository;

use App\Models\InvoiceDetails;

class InvoiceDetailsRepository extends BaseRepository implements IInvoiceDetailsRepository
{
    public function __construct(InvoiceDetails $model)
    {
        parent::__construct($model);
    }
}
