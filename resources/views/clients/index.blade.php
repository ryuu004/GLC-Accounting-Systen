@extends('layouts.app')

@section('content')
    <div class="mx-auto px-4 mb-10">
        <div class="overflow-x-auto bg-white rounded shadow-md">
            <!-- Top Section with Heading and New Client Button -->
            <div class="flex justify-between items-center p-4 bg-gray-100 border-b">
                <h2 class="text-lg font-bold text-gray-800">Clients</h2>
                <a href="{{ route('clients.create') }}" 
                   class="bg-gradient-to-r from-gray-700 to-gray-900 hover:from-gray-800 hover:to-gray-900 text-white font-semibold px-4 py-2 rounded transition duration-300 ease-in-out">
                    Create New Client
                </a>
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div class="bg-green-500 text-white text-center p-4 mt-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Search Form -->
            <div class="p-4 border-b">
                <form method="GET" action="{{ route('clients.index') }}" class="flex">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search clients..." class="border rounded-l p-2 w-full">
                    <button type="submit" class="bg-gradient-to-r from-gray-700 to-gray-500 hover:from-gray-700 hover:to-gray-900 text-white px-4 py-2 rounded-r transition">
                        Search
                    </button>
                </form>
            </div>

            <!-- Clients Table -->
            <table class="min-w-full bg-white text-gray-700">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-4 text-left">ID</th>
                        <th class="py-3 px-4 text-left">Name</th>
                        <th class="py-3 px-4 text-left">Email</th>
                        <th class="py-3 px-4 text-left">Phone</th>
                        <th class="py-3 px-4 text-left">Address</th>
                        <th class="py-3 px-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    @foreach ($clients as $client)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="py-3 px-4">{{ $client->client_id }}</td>
                            <td class="py-3 px-4">{{ $client->name }}</td>
                            <td class="py-3 px-4">{{ $client->email }}</td>
                            <td class="py-3 px-4">{{ $client->phone }}</td>
                            <td class="py-3 px-4">{{ $client->address }}</td>
                            <td class="py-3 px-4">
                                <a href="{{ route('clients.edit', $client) }}" class="text-blue-600 hover:underline mr-3">Edit</a>
                                <form action="{{ route('clients.destroy', $client) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
