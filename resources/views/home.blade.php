@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Portate</div>

                <div class="card-body">
                    <a href="{{ route('type.index') }}">Lista sezioni</a>
                    <a href="{{ route('type.create') }}">Aggiungi sezione</a>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Diete</div>

                <div class="card-body">
                    <a href="{{ route('diet.index') }}">Lista sezioni</a>
                    <a href="{{ route('diet.create') }}">Aggiungi sezione</a>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Piatti</div>

                <div class="card-body">
                    <a href="{{ route('dish.index') }}">Lista piatti</a>
                    <a href="{{ route('dish.create') }}">Aggiungi piatto</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
