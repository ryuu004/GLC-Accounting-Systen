<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Order;
use App\Models\Expense;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Using view composer to calculate and share netAmount globally
        View::composer('*', function ($view) {
            // Calculate total revenue from paid orders
            $totalRevenue = Order::where('status', 'paid')->sum('total_revenue');

            // Calculate total expenses
            $totalExpenses = Expense::sum('total_expense');

            // Calculate net amount
            $netAmount = $totalRevenue - $totalExpenses;

            // Share netAmount with all views
            $view->with('netAmount', $netAmount);
        });
    }

    public function register()
    {
        //
    }
}