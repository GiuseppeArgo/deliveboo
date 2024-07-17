@extends('layouts.admin')

@section('content')
    <div class="form-container w-100 p-5 mt-5">
        @if (count($orders) > 0)
            <div class="d-flex flex-column justify-content-center align-items-center gap-2 mb-4">
                <h1 class="text-center">Lista Ordini</h1>
                <a class="btn btn-primary text-white" href="{{ route('admin.restaurants.index') }}">
                    Torna Alla Home
                </a>
            </div>
            {{-- table --}}
            <table class="table table-responsive order">

                {{-- thead --}}
                <thead>
                    <tr>
                        <th scope="col">N.ordine</th>
                        <th scope="col">Nome</th>
                        {{-- <th scope="col">Cognome</th> --}}
                        <th scope="col">Telefono</th>
                        <th scope="col">Mail</th>
                        <th scope="col">Indirizzo</th>
                        <th scope="col">Data</th>
                        <th scope="col">Totale</th>
                        <th scope="col">Stato</th>
                        <th scope="col" class="text-center">Mostra Ordine</th>
                    </tr>
                </thead>
                {{-- /thead --}}

                {{-- tbody --}}
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td class="align-middle">{{ $order->id }}</td>
                            <td>{{ $order->name }} <br> {{ $order->lastname }}</td>
                            {{-- <td>{{ $order->lastname}}</td> --}}
                            <td class="align-middle">{{ $order->phone_number }}</td>
                            <td class="align-middle">{{ $order->email }}</td>
                            <td class="align-middle">{{ $order->address }}</td>
                            <td class="align-middle">{{ $order->data }}</td>
                            <td class="align-middle">{{ $order->total_price }}€</td>
                            <td class="align-middle">
                                @if ($order->status === 1)
                                    <span class="text-success">
                                        <strong>
                                            OK
                                        </strong>
                                    </span>
                                @else
                                    <span class="text-danger">
                                        <strong>
                                            Cancellato
                                        </strong>
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.orders.show', ['order' => $order->id]) }}" class="btn btn-primary">
                                    >
                                </a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
                {{-- /tbody --}}

            </table>
            {{-- /table --}}
        @else
            <div class="d-flex flex-column justify-content-center align-items-center gap-2">
                <p class="fs-3 p-0 m-0 text-center"><strong>non ci sono ordini</strong></p>
                <a class="btn btn-primary text-white" href="{{ route('admin.restaurants.index') }}">
                    Torna Alla Home
                </a>
            </div>
        @endif
    </div>
@endsection
