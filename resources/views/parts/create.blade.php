@extends('layouts.app')
@section('title', 'Pridať diel')
@section('content')
    <div class="container">
        <h1>Pridať nový diel</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('parts.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Názov dielu</label>
                <input type="text" pattern="^[A-Za-z0-9\s]+$" class="form-control" id="name" name="name" placeholder="Napríklad motor" required>
            </div>

            <div class="mb-3">
                <label for="serialnumber" class="form-label">Serióve číslo</label>
                <input type="number" maxlength="17" class="form-control" id="serialnumber" name="serialnumber" placeholder="Napríklad 1234567890" required>
            </div>

            <div class="mb-3">
                <label for="car_id" class="form-label">Pre ktoré auto?</label>
                <select name="car_id" class="form-control">
                    <option value="">Vyber auto</option>
                    @foreach ($cars as $car)
                        <option value="{{ $car->id }}">{{ $car->name }} - {{ $car->registration_number }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Pridať diel</button>
            <a href="{{ route('parts.index') }}" class="btn btn-secondary">Späť</a>
        </form>
    </div>
@endsection
