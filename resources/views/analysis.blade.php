@extends('layouts.app')

@section('content')

    <div class="container mx-auto p-6 flex space-x-6">
    <!-- Profit Chart Section -->
    <div class="w-2/3 p-4 bg-white rounded-lg shadow-lg">
        <canvas id="profitChart" width="350" height="140" class="mt-4"></canvas>
    </div>

    <!-- Statistics Section -->
    <div class="w-1/3 space-y-6">
        <!-- Total Revenue -->
        <div class="bg-gradient-to-r from-gray-700 to-gray-900 p-6 rounded-lg shadow-lg text-white">
            <h2 class="font-semibold text-center text-lg mb-2">Total Revenue</h2>
            <p class="text-3xl text-center font-bold">₱{{ number_format($totalRevenue, 2) }}</p>
        </div>

        <!-- Total Expenses -->
        <div class="bg-gradient-to-r from-gray-700 to-gray-900 p-6 rounded-lg shadow-lg text-white">
            <h2 class="font-semibold text-center text-lg mb-2">Total Expenses</h2>
            <p class="text-3xl text-center font-bold">₱{{ number_format($totalExpenses, 2) }}</p>
        </div>

        <!-- Key Performance Indicators -->
        <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
            <h2 class="font-semibold text-center text-lg mb-4">Key Performance Indicators</h2>
            <div class="text-center space-y-2">
                <p class="text-md font-medium">Net Profit Margin: 
                    <span class="font-bold">{{ number_format(($totalRevenue - $totalExpenses) / ($totalRevenue ?: 1) * 100, 2) }}%</span>
                </p>
                <p class="text-md font-medium">Expense Ratio: 
                    <span class="font-bold">{{ number_format(($totalExpenses / ($totalRevenue ?: 1)) * 100, 2) }}%</span>
                </p>
                <p class="text-md font-medium">Year-over-Year Growth: 
                    <span class="font-bold">{{ number_format($growthPercentage, 2) }}%</span>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto p-4 flex">
        <!-- Year Selection Form -->
        <form method="GET" action="{{ route('analysis.index') }}" class="mb-4">
            <label for="year" class="font-semibold">Select Year:</label>
            <select id="year" name="year" onchange="this.form.submit()" class="border rounded p-2 ml-2">
                @foreach($years as $yearOption)
                    <option value="{{ $yearOption }}" {{ $yearOption == $year ? 'selected' : '' }}>
                        {{ $yearOption }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    <script>
    // Prepare the data for the chart
    const monthlyProfit = @json($monthlyProfit);
    const labels = Object.keys(monthlyProfit).map(month => {
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        return monthNames[month - 1] + ' {{ $year }}'; // Adjust the year as necessary
    });
    const data = Object.values(monthlyProfit);

    // Create the chart
    const ctx = document.getElementById('profitChart').getContext('2d');
    const profitChart = new Chart(ctx, {
        type: 'bar', // Change to 'line' if preferred
        data: {
            labels: labels,
            datasets: [{
                label: 'Monthly Profit',
                data: data,
                backgroundColor: 'rgba(31, 41, 55, 1)',
                borderColor: 'rgba(75, 85, 99, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#333',
                        callback: function(value) {
                            return '₱' + value;
                        }
                    },
                    grid: {
                        display: false
                    }
                },
                x: {
                    ticks: {
                        color: '#333',
                    },
                    grid: {
                        display: false
                    }
                }
            },
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        color: '#333',
                    }
                }
            }
        }
    });
</script>

@endsection
