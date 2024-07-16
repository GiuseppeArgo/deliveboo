@extends('layouts.admin')

@section('content')

<div class="form-container p-2">
    <h1 class="m-2 text-center">Ordini</h1>
    <table class="table table-responsive striped">
        <thead>
            <tr>
                <th>Id ordine</th>
                <th>Piatto</th>
                <th>Quantity</th>
            </tr>
        </thead>
        @foreach ($orders as $order )
        <tbody>
            <tr>
                <td>
                    {{$order->pivot->order_id}}
                </td>
                <td>
                    {{$order->name}}
                </td>
                <td>
                    {{$order->pivot->quantity}}
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>
</div>
@endsection
