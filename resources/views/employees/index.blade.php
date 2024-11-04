@extends('layouts.app')

@section('content')
    <div class="mx-auto px-4 mb-10"> 
        <div class="overflow-x-auto bg-white rounded shadow-md">
            <!-- Top Section with Heading and New Employee Button -->
            <div class="flex justify-between items-center p-4 bg-gray-100 border-b">
                <h2 class="text-lg font-bold text-gray-800">Employees</h2>
                <a href="{{ route('employees.create') }}" 
                   class="bg-gradient-to-r from-gray-700 to-gray-900 hover:from-gray-800 hover:to-gray-900 text-white font-semibold px-4 py-2 rounded transition duration-300 ease-in-out">
                    Create New Employee
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
                <form method="GET" action="{{ route('employees.index') }}" class="flex">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." class="border rounded-l p-2 w-full">
                    <button type="submit" class="bg-gradient-to-r from-gray-700 to-gray-500 hover:from-gray-700 hover:to-gray-900 text-white px-4 py-2 rounded-r transition">
                        Search
                    </button>
                </form>
            </div>

            <!-- Employees Table -->
            <table class="min-w-full bg-white text-gray-700">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-4 text-left">ID</th>
                        <th class="py-3 px-4 text-left">Name</th>
                        <th class="py-3 px-4 text-left">Position</th>
                        <th class="py-3 px-4 text-left">Email</th>
                        <th class="py-3 px-4 text-left">Phone</th>
                        <th class="py-3 px-4 text-left">Pay/Hour</th>
                        <th class="py-3 px-4 text-left">Hire Date</th>
                        <th class="py-3 px-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    @foreach ($employees as $employee)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="py-3 px-4">{{ $employee->id }}</td>
                            <td class="py-3 px-4">{{ $employee->name }}</td>
                            <td class="py-3 px-4">{{ $employee->position }}</td>
                            <td class="py-3 px-4">{{ $employee->email }}</td>
                            <td class="py-3 px-4">{{ $employee->phone }}</td>
                            <td class="py-3 px-4">₱{{ number_format($employee->payhour, 2) }}</td>
                            <td class="py-3 px-4">{{ $employee->hire_date }}</td>
                            <td class="py-3 px-4">
                                <a href="{{ route('employees.edit', $employee) }}" class="text-blue-600 hover:underline mr-3">Edit</a>
                                <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="inline-block">
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
