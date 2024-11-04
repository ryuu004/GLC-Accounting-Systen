@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto mt-5 mb-10">
        <h2 class="text-2xl font-bold text-gray-800">Create New Employee</h2>

        <form action="{{ route('employees.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6 mt-4">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" required class="mt-1 block w-full border border-gray-300 rounded-md pl-3 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="position" class="block text-sm font-medium text-gray-700">Position</label>
                <input type="text" name="position" id="position" required class="mt-1 block w-full border border-gray-300 rounded-md pl-3 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" required class="mt-1 block w-full border border-gray-300 rounded-md pl-3 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="text" name="phone" id="phone" required class="mt-1 block w-full border border-gray-300 rounded-md pl-3 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="payhour" class="block text-sm font-medium text-gray-700">Pay/Hour</label>
                <input type="number" name="payhour" id="payhour" required class="mt-1 block w-full border border-gray-300 rounded-md pl-3 focus:ring-blue-500 focus:border-blue-500" step="0.01">
            </div>
            <div class="mb-4">
                <label for="hire_date" class="block text-sm font-medium text-gray-700">Hire Date</label>
                <input type="date" name="hire_date" id="hire_date" required class="mt-1 block w-full border border-gray-300 rounded-md pl-3 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <button type="submit" class="w-full bg-gradient-to-r from-gray-700 to-gray-900 hover:from-gray-800 hover:to-gray-900 text-white font-semibold px-4 py-2 rounded transition duration-300 ease-in-out">
                Create Employee
            </button>
        </form>
    </div>
@endsection
