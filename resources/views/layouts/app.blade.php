<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GLC</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">

 <!-- Navbar -->
<div class="fixed top-0 left-0 w-full flex justify-between items-center p-4 bg-white shadow-md">
    <div class="flex items-center">
        <img src="{{ asset('glc_icon.png') }}" alt="Logo" class="h-10 w-auto mr-2">
        <h1 class="text-xl font-semibold font-serif text-gray-500">Printing Services</h1>
    </div>

    <div class="flex space-x-4 ml-auto">

    <a href="{{ route('analysis.index') }}"
       class="px-4 py-2 font-semibold transition duration-300 ease-in-out {{ Route::is('analysis.index') ? 'border-b-2 border-black text-black' : 'text-gray-500' }} hover:text-black">
       Analysis
    </a>

    <a href="{{ route('orders.index') }}"
       class="px-4 py-2 font-semibold transition duration-300 ease-in-out {{ Route::is('orders.index') ? 'border-b-2 border-black text-black' : 'text-gray-500' }} hover:text-black">
       Order Records
    </a>

    <a href="{{ route('expenses.index') }}"
       class="px-4 py-2 font-semibold transition duration-300 ease-in-out {{ Route::is('expenses.index') ? 'border-b-2 border-black text-black' : 'text-gray-500' }} hover:text-black">
       Expenses
    </a>

    <a href="{{ route('employees.index') }}"
       class="px-4 py-2 font-semibold transition duration-300 ease-in-out {{ Route::is('employees.index') ? 'border-b-2 border-black text-black' : 'text-gray-500' }} hover:text-black">
       Employees
    </a>

    <a href="{{ route('clients.index') }}"
       class="px-4 py-2 font-semibold transition duration-300 ease-in-out {{ Route::is('clients.index') ? 'border-b-2 border-black text-black' : 'text-gray-500' }} hover:text-black">
       Clients
    </a>
</div>


</div>


</div>

<!-- Net Amount Display -->
<div class="container mx-auto p-4 mt-20">
    <div class="my-4 p-4 bg-gray-50 p-6 rounded-lg shadow-lg text-green-900 text-center">
        <h2 class="text-3xl font-bold">₱{{ number_format($netAmount, 2) }}</h2> <!-- Increased font size -->
        <p class="text-base">Net Amount</p> <!-- Increased font size -->
    </div>
</div>


        <!-- Page Content -->
        @yield('content')
    </div>

</body>
</html>
