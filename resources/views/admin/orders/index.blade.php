@extends('layouts.admin')

@section('content')

    <div class="mt-5">
        <div class="w-50 text-center m-auto">
            @if (isset($error))
                <div class="alert alert-danger">
                    <span class="text-danger">
                        <strong>{{ $error }}</strong>
                    </span>
                </div>
            @endif
        </div>
    </div>

    {{-- container btn --}}
    <div class="d-flex justify-content-center gap-2">
        <a class="btn btn-primary text-white" href="{{ route('admin.restaurants.index') }}">
            <i class="fa-solid fa-circle-arrow-left"></i>
            Indietro
        </a>
        <a class="btn btn-primary" href="{{ route('admin.stats.index') }}">
            <i class="fa-solid fa-chart-line"></i>
            Statistische
        </a>
    </div>
    {{-- /container btn --}}

    {{-- container  --}}
    <div class="form-container w-100 p-5 mt-3">
        @if (count($orders) > 0)
            {{-- header  --}}
            <div class="mb-4">
                <h1 class="text-center">Lista ordini</h1>
            </div>
            {{-- /header  --}}

            {{-- table --}}
            <div class="table-responsive ">
                <table class="table table-bordered table-hover text-center ">

                    {{-- thead --}}
                    <thead>
                        <tr>
                            <th scope="col ">N.ordine</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Mail</th>
                            <th scope="col">Indirizzo</th>
                            <th scope="col">Data</th>
                            <th scope="col">Totale</th>
                            <th scope="col" class="text-center">Dettagli</th>
                        </tr>
                    </thead>
                    {{-- /thead --}}


                    {{-- tbody --}}
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="text-truncate">
                                <td class="align-middle">{{ $order->id }}</td>
                                <td class="align-middle">{{ ucwords(strtolower($order->name)) }} {{ $order->lastname }}</td>
                                <td class="align-middle">{{ $order->phone_number }}</td>
                                <td class="align-middle">{{ $order->email }}</td>
                                <td class="align-middle">{{ ucwords(strtolower($order->address)) }}</td>
                                <td class="align-middle">{{ $order->date }}</td>
                                <td class="align-middle">{{ $order->total_price }}€</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.orders.show', ['order' => $order->id]) }}"
                                        class="btn btn-outline-primary">
                                        >
                                    </a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                    {{-- /tbody --}}

                </table>

                <!-- Collegamenti di paginazione -->
                <div class="d-flex justify-content-center">
                    {{ $orders->links() }}
                </div>
            </div>
            {{-- /table --}}
        @else
            <div class="flex-center flex-column gap-2">
                <p class="fs-3 p-0 m-0 text-center"><strong>Non ci sono ordini</strong></p>
                <a class="btn btn-primary text-white" href="{{ route('admin.restaurants.index') }}">
                    <i class="fa-solid fa-circle-arrow-left"></i>
                    Home
                </a>
            </div>
        @endif
    </div>
    {{-- /container  --}}

@endsection
