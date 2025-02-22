@extends('layouts.app')
@section('title', 'Upraviť diel')
@section('content')
    <div class="container">
        <h1>Upravuješ diel {{ $part->name }} pre auto s registracnym cislom {{ $part->serialnumber }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('parts.update', $part->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Názov dielu</label>
                <input type="text" pattern="^[A-Za-z]+$" class="form-control" id="name" name="name" value="{{ old('name', $part->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="serialnumber" class="form-label">Seriové číslo</label>
                <input type="number" maxlength="17" class="form-control" id="serialnumber" name="serialnumber" value="{{ old('serialnumber', $part->serialnumber) }}" required>
            </div>

            <div class="mb-3">
                <label for="car_id" class="form-label">Auto</label>
                <select name="car_id" class="form-control">
                    <option value="">Vyber auto</option>
                    @foreach ($cars as $car)
                        <option value="{{ $car->id }}" {{ $part->car_id == $car->id ? 'selected' : '' }}>
                            {{ $car->name }} - {{ $car->registration_number }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-warning">Uložiť zmeny</button>
            <a href="{{ route('parts.index') }}" class="btn btn-secondary">Späť</a>
        </form>
    </div>
@endsection
