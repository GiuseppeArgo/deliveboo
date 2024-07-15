@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h1>Lista Ordini</h1>
        <table class="table table-responsive order">
            <thead>
                <tr>
                    <th scope="col">N.ordine</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Cognome</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Mail</th>
                    <th scope="col">Indirizzo</th>
                    <th scope="col">Data</th>
                    <th scope="col">Totale</th>
                    <th scope="col">Stato</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order )
                <tr>
                    <td scope="row">{{ $order->id }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->lastname}}</td>
                    <td>{{ $order->phone_number}}</td>
                    <td>{{ $order->email}}</td>
                    <td>{{ $order->address}}</td>
                    <td>{{ $order->data}}</td>
                    <td>{{ $order->total_price}}</td>
                    <td>
                        @if($order->status === 1)
                            Avvenuto
                        @else
                            Cancellato
                        @endif
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
