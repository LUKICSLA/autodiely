@extends('layouts.app')
@section('title', 'Zoznam áut')
@section('content')
    <div class="container">
        <h1>Zoznam áut</h1>

        <!-- Filtrovanie -->
        <form method="GET" action="{{ route('cars.index') }}" class="mb-4">
            @csrf
            <div class="row align-items-end">
                <div class="col-md-3">
                    <label for="name" class="form-label">Názov auta</label>
                    <input type="text" pattern="^[A-Za-z\s]+$" name="name" class="form-control" placeholder="Názov auta (značka)" value="{{ request('name') }}">
                </div>

                <div class="col-md-3">
                    <label for="is_registered" class="form-label">Registrované</label>
                    <select name="is_registered" class="form-control">
                        <option value="">Vylistuj všetky</option>
                        <option value="1" {{ request('is_registered') == '1' ? 'selected' : '' }}>Áno</option>
                        <option value="0" {{ request('is_registered') == '0' ? 'selected' : '' }}>Nie</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary mt-4">Filtrovať</button>
                </div>
            </div>
        </form>

        <!-- Tlačidlo na pridanie nového auta -->
        <div class="mb-3">
            <a href="{{ route('cars.create') }}" class="btn btn-success">Pridať nové auto</a>
        </div>

        <!-- Zobrazenie áut -->
        <table class="table">
            <thead>
                <tr>
                    <th>Názov auta</th>
                    <th>Registračné číslo</th>
                    <th>Je registrované?</th>
                    <th>Operácie</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cars as $car)
                    <tr>
                        <td>{{ $car->name }}</td>
                        <td>{{ $car->registration_number ?? 'Nešpecifikované' }}</td> <!-- Ak nie je registrované, zobrazí sa Nešpecifikované -->
                        <td>{{ $car->is_registered ? 'Áno' : 'Nie' }}</td> <!-- Ak je registrované, zobrazí sa Áno, inak Nie -->
                        <td>
                            <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-warning btn-sm">Upraviť</a>
                            @if (Auth::check()) <form action="{{ route('cars.destroy', $car->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Ste si istý, že chcete zmazať toto auto?')">Zmazať</button>
                            </form> @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- stránkovanie -->
        <div class="d-flex justify-content-center">
            {{ $cars->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
