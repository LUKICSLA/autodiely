@extends('layouts.app')
@section('title', 'Zmazať diel')
@section('content')
    <div class="container">
        <h1>Si si istý, že chces zmazať diel: {{ $part->name }}?</h1>
        <p><strong>Auto:</strong> {{ $part->car->name }} - {{ $part->car->registration_number }}</p>

        <form action="{{ route('parts.destroy', $part->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Áno, zmazať diel</button>
            <a href="{{ route('parts.index') }}" class="btn btn-secondary">Späť</a>
        </form>
    </div>
@endsection
