@if (session('message'))
    <div class="alert alert-success form-container text-center border-0">
        {{ session('message') }}
    </div>
@endif
