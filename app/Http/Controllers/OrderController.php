<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Validation\Rule;


class OrderController extends Controller
{
    public function index(Request $request)
    {
        // Get the search query from the request
        $search = $request->input('search');

        // Query the orders with optional search and sorting
        $orders = Order::query()
            ->when($search, function ($query, $search) {
                return $query->where('order_id', 'like', "%{$search}%")
                             ->orWhere('client_id', 'like', "%{$search}%")
                             ->orWhere('type', 'like', "%{$search}%")
                             ->orWhereYear('date', $search);
            })
            ->orderBy('date', 'desc')
            ->get();

        $netAmount = Order::sum('total_revenue');
        
        return view('orders.index', compact('orders', 'netAmount', 'search'));
    }

    public function create()
    {
        return view('orders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|unique:orders,order_id',
            'date' => 'required|date',
            'type' => 'required',
            'client_id' => 'required',
            'quantity' => 'required|integer',
            'total_revenue' => 'required|numeric',
            'status' => 'required|in:paid,unpaid',
        ], [
            'order_id.unique' => 'The order ID has already been taken.',
        ]);

        Order::create($request->all());
        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'order_id' => [
                'required',
                // Ensure the order_id is unique, ignoring the current order's ID
                Rule::unique('orders')->ignore($order->id), 
            ],
            'date' => 'required|date',
            'type' => 'required',
            'client_id' => 'required',
            'quantity' => 'required|integer',
            'total_revenue' => 'required|numeric',
            'status' => 'required|in:paid,unpaid',
        ], [
            'order_id.unique' => 'The order ID has already been taken.', // Custom error message
        ]);

        $order->update($request->all());
        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
