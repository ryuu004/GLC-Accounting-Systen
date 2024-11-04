@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto mt-5 mb-10">
        <h2 class="text-2xl font-bold text-gray-800">Edit Order</h2>

        <form action="{{ route('orders.update', $order) }}" method="POST" class="bg-white shadow-md rounded-lg p-6 mt-4">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="order_id" class="block text-sm font-medium text-gray-700">Order ID</label>
                <input type="text" name="order_id" id="order_id" value="{{ $order->order_id }}" required 
                    class="mt-1 block w-full border border-gray-300 rounded-md pl-3 py-2 focus:ring-gray-500 focus:border-gray-500 transition duration-200 ease-in-out">
            </div>
            <div class="mb-4">
                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                <input type="date" name="date" id="date" value="{{ $order->date }}" required 
                    class="mt-1 block w-full border border-gray-300 rounded-md pl-3 py-2 focus:ring-gray-500 focus:border-gray-500 transition duration-200 ease-in-out">
            </div>
            <div class="mb-4">
                <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                <input type="text" name="type" id="type" value="{{ $order->type }}" required 
                    class="mt-1 block w-full border border-gray-300 rounded-md pl-3 py-2 focus:ring-gray-500 focus:border-gray-500 transition duration-200 ease-in-out">
            </div>
            <div class="mb-4">
                <label for="client_id" class="block text-sm font-medium text-gray-700">Client ID</label>
                <input type="text" name="client_id" id="client_id" value="{{ $order->client_id }}" required 
                    class="mt-1 block w-full border border-gray-300 rounded-md pl-3 py-2 focus:ring-gray-500 focus:border-gray-500 transition duration-200 ease-in-out">
            </div>
            <div class="mb-4">
                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                <input type="number" name="quantity" id="quantity" value="{{ $order->quantity }}" required 
                    class="mt-1 block w-full border border-gray-300 rounded-md pl-3 py-2 focus:ring-gray-500 focus:border-gray-500 transition duration-200 ease-in-out">
            </div>
            <div class="mb-4">
                <label for="total_revenue" class="block text-sm font-medium text-gray-700">Total Revenue</label>
                <input type="number" name="total_revenue" id="total_revenue" value="{{ $order->total_revenue }}" required 
                    class="mt-1 block w-full border border-gray-300 rounded-md pl-3 py-2 focus:ring-gray-500 focus:border-gray-500 transition duration-200 ease-in-out" step="0.01">
            </div>
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" required 
                    class="mt-1 block w-full border border-gray-300 rounded-md pl-3 py-2 focus:ring-gray-500 focus:border-gray-500 transition duration-200 ease-in-out">
                    <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="unpaid" {{ $order->status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                </select>
            </div>
            <button type="submit" class="w-full bg-gradient-to-r from-gray-700 to-gray-900 hover:from-gray-800 hover:to-gray-900 text-white font-semibold px-4 py-2 rounded transition duration-300 ease-in-out">
                Update Order
            </button>
        </form>
        @if ($errors->any())
    <div class="alert alert-danger text-red-700">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    </div>
@endsection
