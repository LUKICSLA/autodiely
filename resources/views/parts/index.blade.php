@extends('layouts.app')
@section('title', 'Zoznam dielov')
@section('content')
    <div class="container">
        <h1>Zoznam dielov</h1>

        <!-- Filtrovanie -->
        <form action="{{ route('parts.index') }}" method="GET" class="mb-3">
            @csrf
            <div class="row align-items-end">
            <div class="col-md-4">
                <label for="name" class="form-label">Názov dielu</label>
                <input type="text" pattern="^[A-Za-z\s]+$" name="search" class="form-control" placeholder="Názov dielu (napríklad motor)" value="{{ request()->get('search') }}">
            </div>
            <div class="col-md-4">
                <label for="car_id" class="form-label">Pre ktoré auto?</label>
                <select name="car_id" class="form-control">
                <option value="">Vyber auto</option>
                @foreach ($cars as $car)
                    <option value="{{ $car->id }}" {{ request()->get('car_id') == $car->id ? 'selected' : '' }}>
                    {{ $car->name }} - {{ $car->registration_number }}
                    </option>
                @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filtrovať</button>
            </div>
            </div>
        </form>

        <div class="mb-3">
            <a href="{{ route('parts.create') }}" class="btn btn-success">Pridať nový diel</a>
        </div>

        <!-- Zoznam dielov -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Názov dielu</th>
                    <th>Seriove císlo</th>
                    <th>Auto</th>
                    <th>Operácia</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($parts as $part)
                    <tr>
                        <td>{{ $part->name }}</td>
                        <td>{{ $part->serialnumber }}</td>
                        <td>{{ $part->car->name }} - {{ $part->car->registration_number }}</td>
                        <td>
                            <a href="{{ route('parts.edit', $part->id) }}" class="btn btn-warning btn-sm">Upraviť</a>
                            @if (Auth::check()) <form action="{{ route('parts.destroy', $part->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Si si istý, že chceš zmazať tento diel?')">Zmazať</button>
                            </form> @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $parts->appends(request()->query())->links() }} <!-- strankovanie -->
    </div>
@endsection