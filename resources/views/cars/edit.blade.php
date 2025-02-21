@extends('layouts.app')
@section('title', 'Upraviť auto')
@section('content')
    <div class="container">
        <h1>Upravuješ auto {{ $car->name }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('cars.update', $car->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Názov auta</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $car->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="is_registered" class="form-label">Registrované</label>
                <select class="form-control" id="is_registered" name="is_registered" onchange="toggleRegistrationNumber()">
                    <option value="0" {{ $car->is_registered == 0 ? 'selected' : '' }}>Nie</option>
                    <option value="1" {{ $car->is_registered == 1 ? 'selected' : '' }}>Áno</option>
                </select>
            </div>

            <div class="mb-3" id="registration_number_field" style="{{ $car->is_registered ? 'display:block;' : 'display:none;' }}">
                <label for="registration_number" class="form-label">Registračné číslo</label>
                <input type="text" class="form-control" id="registration_number" name="registration_number" value="{{ old('registration_number', $car->registration_number) }}">
            </div>

            <button type="submit" class="btn btn-success">Uložiť zmeny</button>
            <a href="{{ route('cars.index') }}" class="btn btn-secondary">Späť</a>
        </form>
    </div>

    <script>
        function toggleRegistrationNumber() {
            let isRegistered = document.getElementById('is_registered').value;
            let regField = document.getElementById('registration_number_field');
            if (isRegistered == '1') {
                regField.style.display = 'block';
            } else {
                regField.style.display = 'none';
            }
        }
    </script>
@endsection
