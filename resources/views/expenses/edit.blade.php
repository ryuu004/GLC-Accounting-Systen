@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto mt-5 mb-10">
        <h2 class="text-2xl font-bold text-gray-800">Edit Expense</h2>

        <form action="{{ route('expenses.update', $expense) }}" method="POST" class="bg-white shadow-md rounded-lg p-6 mt-4">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="expense_id" class="block text-sm font-medium text-gray-700">Expense ID</label>
                <input type="text" name="expense_id" id="expense_id" value="{{ $expense->expense_id }}" required 
                    class="mt-1 block w-full border border-gray-300 rounded-md pl-3 py-2 focus:ring-gray-500 focus:border-gray-500 transition duration-200 ease-in-out">
            </div>
            <div class="mb-4">
                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                <input type="date" name="date" id="date" value="{{ $expense->date }}" required 
                    class="mt-1 block w-full border border-gray-300 rounded-md pl-3 py-2 focus:ring-gray-500 focus:border-gray-500 transition duration-200 ease-in-out">
            </div>
            <div class="mb-4">
                <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                <input type="text" name="type" id="type" value="{{ $expense->type }}" required 
                    class="mt-1 block w-full border border-gray-300 rounded-md pl-3 py-2 focus:ring-gray-500 focus:border-gray-500 transition duration-200 ease-in-out">
            </div>
            <div class="mb-4">
                <label for="total_expense" class="block text-sm font-medium text-gray-700">Total Expense</label>
                <input type="number" name="total_expense" id="total_expense" value="{{ $expense->total_expense }}" required 
                    class="mt-1 block w-full border border-gray-300 rounded-md pl-3 py-2 focus:ring-gray-500 focus:border-gray-500 transition duration-200 ease-in-out" step="0.01">
            </div>
            <button type="submit" class="w-full bg-gradient-to-r from-gray-700 to-gray-900 hover:from-gray-800 hover:to-gray-900 text-white font-semibold px-4 py-2 rounded transition duration-300 ease-in-out">
                Update Expense
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
