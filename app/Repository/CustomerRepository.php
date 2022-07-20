<?php

namespace App\Repository;

use App\Models\Customer;

class CustomerRepository extends BaseRepository implements ICustomerRepository
{
    public function __construct(Customer $model)
    {
        parent::__construct($model);
    }
}
