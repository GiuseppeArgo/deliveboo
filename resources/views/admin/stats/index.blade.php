@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-center mt-5 gap-2">
        {{-- btn home --}}
        <a class="btn btn-primary" href="{{ route('admin.orders.index') }}">
            <i class="fa-solid fa-circle-arrow-left"></i>
            Indietro
        </a>
        {{-- btn home --}}
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            {{-- header --}}
            <div class="d-flex gap-2 justify-content-center align-items-center mt-5">
                <div class="d-flex flex-column justify-content-center align-items-center gap-2 mb-2">
                    <h1 class="text-center p-0">Statistiche degli Ordini</h1>
                </div>
            </div>
            {{-- /header --}}

            <div class="d-flex justify-content-center mb-5">
                <form method="GET" action="{{ route('admin.stats.index') }}" class="d-flex gap-2">
                    <div>
                        <label for="year">Anno:</label>
                        <input type="number" id="year" name="year" value="{{ $year }}" class="form-control">
                    </div>
                    <div>
                        <label for="month">Mese:</label>
                        <input type="number" id="month" name="month" value="{{ $month }}" class="form-control">
                    </div>
                    <div class="d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Filtra</button>
                    </div>
                </form>
            </div>

            {{-- Orders graph --}}
            <div class="chart-section d-flex flex-column align-items-center mb-5">
                <h3 class="text-left">Ordini per giornata</h3>
                <p class="text-left">Totale numero ordini del mese selezionato: {{ $totalOrders }}</p>
                <div class="select-container">
                    <select class="my_select" id="orderChartTypeSelector">
                        <option value="line">Linee</option>
                        <option value="bar">Barre</option>
                    </select>
                    <i class="fas fa-chevron-down select-icon"></i>
                </div>
                <div class="chart-container">
                    <canvas id="orderChart"></canvas>
                </div>
            </div>
            {{-- /Orders graph --}}

            {{-- Price graph --}}
            <div class="chart-section d-flex flex-column align-items-center">
                <h3 class="text-left">Guadagni della giornata</h3>
                <p class="text-left">Totale guadagnato nel mese selezionato: {{ number_format($totalEarnings, 2) }} €</p>
                <div class="select-container">
                    <select id="chartTypeSelector">
                        <option value="bar">Barre</option>
                        <option value="line">Linee</option>
                    </select>
                    <i class="fas fa-chevron-down select-icon"></i>
                </div>
                <div class="chart-container">
                    <canvas id="PriceChart"></canvas>
                </div>
            </div>
            {{-- /Price graph --}}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Order graph (first graph)
        document.addEventListener('DOMContentLoaded', (event) => {
            const orderCtx = document.getElementById('orderChart').getContext('2d');

            const lineDataset = {
                label: 'Ordini',
                data: @json(array_values($data)),
                borderColor: 'blue',
                borderWidth: 2,
                fill: false,
                tension: 0.1,
                type: 'line'
            };

            const barDataset = {
                label: 'Ordini',
                data: @json(array_values($data)),
                backgroundColor: 'blue',
                borderWidth: 2,
                fill: false,
                type: 'bar'
            };

            const data = {
                labels: @json(array_keys($data)),
                datasets: [lineDataset] // Start with line dataset
            };

            const options = {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            };

            let orderChart = new Chart(orderCtx, {
                data: data,
                options: options
            });

            document.getElementById('orderChartTypeSelector').addEventListener('change', (event) => {
                const selectedType = event.target.value;
                orderChart.destroy();
                if (selectedType === 'line') {
                    orderChart = new Chart(orderCtx, {
                        type: 'line',
                        data: {
                            labels: @json(array_keys($data)),
                            datasets: [lineDataset]
                        },
                        options: options
                    });
                } else if (selectedType === 'bar') {
                    orderChart = new Chart(orderCtx, {
                        type: 'bar',
                        data: {
                            labels: @json(array_keys($data)),
                            datasets: [barDataset]
                        },
                        options: options
                    });
                }
            });
        });

        // Price graph (second graph)
        document.addEventListener('DOMContentLoaded', (event) => {
            const priceCtx = document.getElementById('PriceChart').getContext('2d');

            const lineDataset = {
                label: 'Guadagni in €',
                data: @json(array_values($totalPrices)),
                borderColor: 'red',
                borderWidth: 2,
                fill: false,
                tension: 0.1,
                type: 'line'
            };

            const barDataset = {
                label: 'Guadagni in €',
                data: @json(array_values($totalPrices)),
                backgroundColor: 'red',
                borderWidth: 2,
                fill: false,
                type: 'bar'
            };

            const data = {
                labels: @json(array_keys($totalPrices)),
                datasets: [barDataset] // Start with bar dataset
            };

            const options = {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value, index, values) {
                                return value + ' €';
                            }
                        }
                    }
                }
            };

            let priceChart = new Chart(priceCtx, {
                data: data,
                options: options
            });

            document.getElementById('chartTypeSelector').addEventListener('change', (event) => {
                const selectedType = event.target.value;
                priceChart.destroy();
                if (selectedType === 'line') {
                    priceChart = new Chart(priceCtx, {
                        type: 'line',
                        data: {
                            labels: @json(array_keys($totalPrices)),
                            datasets: [lineDataset]
                        },
                        options: options
                    });
                } else if (selectedType === 'bar') {
                    priceChart = new Chart(priceCtx, {
                        type: 'bar',
                        data: {
                            labels: @json(array_keys($totalPrices)),
                            datasets: [barDataset]
                        },
                        options: options
                    });
                }
            });
        });
    </script>

    <style>
        .chart-section {
            width: 100%;
            max-width: 800px;
        }

        .chart-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 100%;
        }

        .chart-wrapper {
            width: 100%;
        }

        .select-container {
            position: relative;
            display: inline-block;
            width: 200px;
        }

        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border: 1px solid lightgray;
            background-color: white;
            padding: 5px;
            font-size: 16px;
            color: black;
            width: 100%;
            cursor: pointer;
            outline: none;
            border-radius: 10px;
        }

        .select-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            pointer-events: none;
            color: black;
        }

        select option {
            background-color: white;
            color: black;
            padding: 10px;
        }

        select:hover,
        select:focus {
            border: 1px solid black;
        }


        form {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        form label,
        form input,
        form button {
            margin: 0 10px;
        }

        .text-left {
            width: 100%;
            text-align: left;
            margin-bottom: 10px;
        }
    </style>
@endsection

