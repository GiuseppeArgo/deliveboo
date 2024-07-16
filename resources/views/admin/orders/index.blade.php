@extends('layouts.admin')

@section('content')
    <div class="form-container w-100 p-5 mt-5">
        <h1 class="text-center mb-4">Lista Ordini</h1>

        {{-- table --}}
        <table class="table table-responsive order">

            {{-- thead --}}
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
                    <th scope="col">Bottone</th>
                </tr>
            </thead>
            {{-- /thead --}}

            {{-- tbody --}}
            <tbody>
                @foreach ($orders as $order )
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->lastname}}</td>
                    <td>{{ $order->phone_number}}</td>
                    <td>{{ $order->email}}</td>
                    <td>{{ $order->address}}</td>
                    <td>{{ $order->data}}</td>
                    <td>{{ $order->total_price}}€</td>
                    <td>
                        @if($order->status === 1)
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
                    <td>
                        <a href="{{ route('admin.orders.show', ['order' => $order->id]) }}"
                            class="btn btn-info">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </td>

                </tr>
                @endforeach
            </tbody>
            {{-- /tbody --}}

        </table>
        {{-- /table --}}
    </div>
@endsection
