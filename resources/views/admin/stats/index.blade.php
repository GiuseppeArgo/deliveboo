@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-center mt-5 gap-2">
        {{-- btn home --}}
        <a class="btn btn-primary" href="{{ route('admin.restaurants.index') }}">
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

            <div class="chart-section d-flex flex-column align-items-center mb-5">
                <h3 class="text-left">Ordini per giornata</h3>
                <div class="chart-container">
                    <canvas id="orderChart"></canvas>
                </div>
            </div>

            <div class="chart-section d-flex flex-column align-items-center">
                <h3 class="text-left">Guadagni della giornata</h3>
                <div class="chart-container">
                    <canvas id="PriceChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const orderCtx = document.getElementById('orderChart').getContext('2d');
            const orderChart = new Chart(orderCtx, {
                type: 'line',
                data: {
                    labels: @json(array_keys($data)),
                    datasets: [{
                        label: 'Ordini',
                        data: @json(array_values($data)),
                        borderColor: 'blue',
                        borderWidth: 2,
                        fill: false,
                        tension: 0.1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });

        document.addEventListener('DOMContentLoaded', (event) => {
            const priceCtx = document.getElementById('PriceChart').getContext('2d');
            const priceChart = new Chart(priceCtx, {
                type: 'line',
                data: {
                    labels: @json(array_keys($totalPrices)),
                    datasets: [{
                        label: 'Guadagni in €',
                        data: @json(array_values($totalPrices)),
                        borderColor: 'red',
                        borderWidth: 2,
                        fill: false,
                        tension: 0.1
                    }]
                },
                options: {
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