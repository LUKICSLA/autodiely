@extends('layouts.app')
@section('title', 'Pridať auto')
@section('content')
    <div class="container">
        <h1>Pridať nové auto</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('cars.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Názov auta</label>
                <input type="text" pattern="^[A-Za-z\s]+$" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label for="is_registered" class="form-label">Registrované</label>
                <select class="form-control" id="is_registered" name="is_registered" onchange="toggleRegistrationNumber()">
                    <option value="0">Nie</option>
                    <option value="1">Áno</option>
                </select>
            </div>

            <div class="mb-3" id="registration_number_field" style="display: none;">
                <label for="registration_number" class="form-label">Registračné číslo</label>
                <input type="number" class="form-control" id="registration_number" maxlength="17" name="registration_number" value="{{ old('registration_number') }}">
            </div>

            <button type="submit" class="btn btn-success">Uložiť</button>
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
