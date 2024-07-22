@extends('layouts.admin')

@section('content')

    {{-- container --}}
    <div class="form-container p-2">

        {{-- header --}}
        <div class="d-flex justify-content-center flex-column align-items-center mb-4">
            <h1 class="m-2 text-center">Ordini</h1>
            {{-- Btn orders --}}
            <form action="{{ route('admin.orders.index') }}" method="GET">
                @csrf
                <input type="text" class="hide" name="restaurant_id" value="{{ $orders['restaurant_id'] }}">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-list-ul"></i> Torna agli ordini
                </button>
            </form>
            {{-- /Btn orders --}}
        </div>
        {{-- /header --}}

        {{-- table --}}
        <table class="table table-responsive striped">

            {{-- thead --}}
            <thead>
                <tr>
                    <th>Piatto</th>
                    <th>Quantity</th>
                    <th>Prezzo</th>
                </tr>
            </thead>
            {{-- /thead --}}

            
            {{-- tbody --}}
            @foreach ($orders['dishes'] as $order)
                <tbody>
                    <tr>
                        <td>
                            {{ $order->name }}
                        </td>
                        <td>
                            {{ $order->pivot->quantity }}
                        </td>
                        <td>
                            {{ $order->price * $order->pivot->quantity }}€
                        </td>
                    </tr>
                </tbody>
            @endforeach
            {{-- /tbody --}}

        </table>
        {{-- /table --}}

    </div>
    {{-- /container --}}

@endsection
