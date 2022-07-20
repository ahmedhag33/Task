<?php

namespace App\Providers;

use App\Repository\BaseRepository;
use App\Repository\CustomerRepository;
use App\Repository\IBaseRepository;
use App\Repository\ICustomerRepository;
use App\Repository\IInvoiceDetailsRepository;
use App\Repository\IInvoiceRepository;
use App\Repository\InvoiceDetailsRepository;
use App\Repository\InvoiceRepository;
use App\Repository\IProductRepository;
use App\Repository\ProductRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IBaseRepository::class, BaseRepository::class);
        $this->app->bind(ICustomerRepository::class, CustomerRepository::class);
        $this->app->bind(IProductRepository::class, ProductRepository::class);
        $this->app->bind(IInvoiceRepository::class, InvoiceRepository::class);
        $this->app->bind(IInvoiceDetailsRepository::class, InvoiceDetailsRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
