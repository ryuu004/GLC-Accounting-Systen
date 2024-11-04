@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto mt-5 mb-10">
        <h2 class="text-2xl font-bold text-gray-800">Create New Client</h2>

        <form action="{{ route('clients.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6 mt-4">
            @csrf
            <div class="mb-4">
                <label for="client_id" class="block text-sm font-medium text-gray-700">ID</label>
                <input type="text" name="client_id" id="client_id" required 
                    class="mt-1 block w-full border border-gray-300 rounded-md pl-3 py-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out">
            </div>
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" required 
                    class="mt-1 block w-full border border-gray-300 rounded-md pl-3 py-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" required 
                    class="mt-1 block w-full border border-gray-300 rounded-md pl-3 py-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out">
            </div>
            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="text" name="phone" id="phone" required 
                    class="mt-1 block w-full border border-gray-300 rounded-md pl-3 py-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out">
            </div>
            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                <input type="text" name="address" id="address" required 
                    class="mt-1 block w-full border border-gray-300 rounded-md pl-3 py-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out">
            </div>
            <button type="submit" class="w-full bg-gradient-to-r from-gray-700 to-gray-900 hover:from-gray-800 hover:to-gray-900 text-white font-semibold px-4 py-2 rounded transition duration-300 ease-in-out">
                Create Client
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
