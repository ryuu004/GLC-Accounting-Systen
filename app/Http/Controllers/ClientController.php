<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        // Get the search query from the request
        $search = $request->input('search');

        // Query the clients with optional search and sorting
        $clients = Client::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%")
                             ->orWhere('phone', 'like', "%{$search}%")
                             ->orWhere('address', 'like', "%{$search}%");
            })
            ->orderBy('name', 'asc')
            ->get();

        return view('clients.index', compact('clients', 'search'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|unique:clients,client_id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:clients',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
        ], [
            'client_id.unique' => 'The client ID has already been taken.',
        ]);

        Client::create($request->all());
        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'client_id' => [
                'required',
                Rule::unique('clients')->ignore($client->id), 
            ],
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:clients,email,' . $client->id,
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
        ],[
            'client_id.unique' => 'The unique ID has already been taken.',
        ]);


        $client->update($request->all());
        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }
}
