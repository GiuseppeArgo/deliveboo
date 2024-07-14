@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Ristorante: {{ $restaurant->name }}</h3>
    @if ($restaurant->dishes->isEmpty())
        <p>Non ci sono piatti disponibili per questo ristorante.</p>
    @else
        <ul>
            @foreach($restaurant->dishes as $dish)
                <li>
                    <strong>Descrizione:</strong> {{ $dish->description }}<br>
                    <strong>Prezzo:</strong> {{ $dish->price }}
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection