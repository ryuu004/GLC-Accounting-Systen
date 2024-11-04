@extends('layouts.app')

@section('content')
    <div class=" mx-auto px-4 mb-10"> <!-- Added max-width, centered container, and padding -->
        <div class="overflow-x-auto bg-white rounded shadow-md">
            <!-- Top Section with Heading and New Order Button -->
            <div class="flex justify-between items-center p-4 bg-gray-100 border-b">
                <h2 class="text-lg font-bold text-gray-800">Orders</h2>
                <a href="{{ route('orders.create') }}" class="bg-gradient-to-r from-gray-700 to-gray-900 hover:from-gray-800 hover:to-gray-900 text-white font-semibold px-4 py-2 rounded transition duration-300 ease-in-out">
                    Create New Order    
                </a>
            </div>

            <!-- Search Form -->
            <div class="p-4 border-b">
                <form method="GET" action="{{ route('orders.index') }}" class="flex">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search orders..." class="border rounded-l p-2 w-full">
                    <button type="submit" class="bg-gradient-to-r from-gray-700 to-gray-500 hover:from-gray-700 hover:to-gray-900 text-white px-4 py-2 rounded-r transition">
                        Search
                    </button>
                </form>
            </div>

            <!-- Orders Table -->
            <table class="min-w-full bg-white text-gray-700">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-4 text-left">ID</th>
                        <th class="py-3 px-4 text-left">Date</th>
                        <th class="py-3 px-4 text-left">Type</th>
                        <th class="py-3 px-4 text-left">Client ID</th>
                        <th class="py-3 px-4 text-left">Quantity</th>
                        <th class="py-3 px-4 text-left">Total Revenue</th>
                        <th class="py-3 px-4 text-left">Status</th>
                        <th class="py-3 px-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    @foreach ($orders as $order)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="py-3 px-4">{{ $order->order_id }}</td>
                            <td class="py-3 px-4">{{ $order->date }}</td>
                            <td class="py-3 px-4">{{ $order->type }}</td>
                            <td class="py-3 px-4">{{ $order->client_id }}</td>
                            <td class="py-3 px-4">{{ $order->quantity }}</td>
                            <td class="py-3 px-4">₱{{ number_format($order->total_revenue, 2) }}</td>
                            <td class="py-3 px-4">
                                <span class="text-white text-sm font-semibold py-1 px-3 rounded {{ $order->status == 'paid' ? 'bg-green-500' : 'bg-red-500' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <a href="{{ route('orders.edit', $order) }}" class="text-blue-600 hover:underline mr-3">Edit</a>
                                <form action="{{ route('orders.destroy', $order) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Success Message -->
            @if (session('success'))
                <div class="bg-green-500 text-white text-center p-4 mt-4 rounded">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>
@endsection
