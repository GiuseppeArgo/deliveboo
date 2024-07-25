


<div>
    <h1>Riepilogo del tuo ordine: </h1>
    <p>Pagamento dell ordine: {{ $lead->price }} €</p>
    <p>Ordine n. {{ $lead->order }}</p>

    <p>Gentile {{$lead->name }} {{ $lead->lastname }},
        siamo felici di comunicarti che il tuo ordine è avvenuto con successo.<br>
        Vogliamo inoltre ricordati che la nostra politica prevede che l'ordine
        ti venga consegnato entro 30 minuti dalla ricezione di questa email
        o verrai rimborsato.<br><br><br>
                                Grazie per averci scelto Dal Team di Deliveboo.
    </p>
</div>
