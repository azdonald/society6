<?php


namespace App\Providers;


use Illuminate\Support\ServiceProvider;

class InterfaceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind("App\Repositories\interfaces\UserInterface", "App\Repositories\UserRepository");
        $this->app->bind("App\Repositories\interfaces\CreativeInterface", "App\Repositories\CreativeRepository");
        $this->app->bind("App\Repositories\interfaces\CustomerInterface", "App\Repositories\CustomerRepository");
        $this->app->bind("App\Repositories\interfaces\OrderInterface", "App\Repositories\OrderRepository");
        $this->app->bind("App\Repositories\interfaces\OrderLineItemInterface", "App\Repositories\OrderLineItemRepository");
        $this->app->bind("App\Repositories\interfaces\ProductInterface", "App\Repositories\ProductRepository");
        $this->app->bind("App\Repositories\interfaces\ProductTypeInterface", "App\Repositories\ProductTypeRepository");
        $this->app->bind("App\Repositories\interfaces\VendorInterface", "App\Repositories\VendorRepository");
    }
}
