<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Expense;
use Illuminate\Http\Request;

class AnalysisController extends Controller
{
    public function index(Request $request)
    {
        // Get the selected year from the request or use the current year
        $year = $request->input('year', date('Y'));

        // Retrieve revenue and expense data
        $revenues = Order::selectRaw('MONTH(date) as month, SUM(total_revenue) as total')
            ->whereYear('date', $year)
            ->groupBy('month')
            ->pluck('total', 'month');

        $expenses = Expense::selectRaw('MONTH(date) as month, SUM(total_expense) as total')
            ->whereYear('date', $year)
            ->groupBy('month')
            ->pluck('total', 'month');

        // Calculate monthly profit
        $monthlyProfit = [];
        for ($month = 1; $month <= 12; $month++) {
            $revenue = $revenues->get($month, 0);
            $expense = $expenses->get($month, 0);
            $monthlyProfit[$month] = $revenue - $expense;
        }

        // Get the total revenue and total expenses
        $totalRevenue = Order::whereYear('date', $year)->sum('total_revenue');
        $totalExpenses = Expense::whereYear('date', $year)->sum('total_expense');

        // Get the last year's revenue for growth calculation
        $lastYearRevenue = Order::whereYear('date', $year - 1)->sum('total_revenue');
        $growthPercentage = $lastYearRevenue > 0 ? (($totalRevenue - $lastYearRevenue) / $lastYearRevenue) * 100 : 0;

        // Get the list of years available (you can customize this according to your data)
        $years = range(date('Y') - 5, date('Y'));

        return view('analysis', compact('monthlyProfit', 'year', 'years', 'totalRevenue', 'totalExpenses', 'growthPercentage'));
    }
}
