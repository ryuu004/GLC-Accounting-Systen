<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        // Get the search query from the request
        $search = $request->input('search');

        // Query the expenses with optional search and sorting
        $expenses = Expense::query()
            ->when($search, function ($query, $search) {
                return $query->where('expense_id', 'like', "%{$search}%")
                             ->orWhere('type', 'like', "%{$search}%")
                             ->orWhere('date', 'like', "%{$search}%");
            })
            ->orderBy('date', 'desc')
            ->get();

        return view('expenses.index', compact('expenses', 'search'));
    }

    public function create()
    {
        return view('expenses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'expense_id' => 'required|unique:expenses,expense_id',
            'date' => 'required|date',
            'type' => 'required',
            'total_expense' => 'required|numeric',
        ], [
            'expense_id.unique' => 'The expense ID has already been taken.',
        ]);

        Expense::create($request->all());
        return redirect()->route('expenses.index')->with('success', 'Expense created successfully.');
    }

    public function edit(Expense $expense)
    {
        return view('expenses.edit', compact('expense'));
    }

    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'expense_id' => [
                'required',
                // Ensure the expense_id is unique, ignoring the current expense ID
                Rule::unique('expenses')->ignore($expense->id), 
            ],
            'date' => 'required|date',
            'type' => 'required',
            'total_expense' => 'required|numeric',
        ], [
            'expense_id.unique' => 'The expense ID has already been taken.',
        ]);
        $expense->update($request->all());
        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully.');
    }
}
