<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::query();
    
        // Filtrovanie podľa názvu auta
        if ($request->has('name') && $request->name != '') {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
    
        // Filtrovanie podľa registračného čísla
        if ($request->has('registration_number') && $request->registration_number != '') {
            $query->where('registration_number', 'like', '%' . $request->registration_number . '%');
        }
    
        // Filtrovanie podľa stavu registrácie
        if ($request->has('is_registered') && $request->is_registered !== '') {
            $query->where('is_registered', $request->is_registered);
        }
    
        // Získať filtrované dáta cez stránkovanie
        $cars = $query->paginate(10);
        return view('cars.index', compact('cars'));
    }

    public function create()
    {
        return view('cars.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'registration_number' => 'required_if:is_registered,1|unique:cars,registration_number',
            'is_registered' => 'boolean',
        ]);

        Car::create($request->all());
        return redirect()->route('cars.index')->with('success', 'Auto bolo pridané.');
    }

    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $request->validate([
            'name' => 'required',
            'registration_number' => 'required_if:is_registered,1',
            'is_registered' => 'boolean',
        ]);

        $car->update($request->all());
        return redirect()->route('cars.index')->with('success', 'Auto bolo updtnuté.');
    }

    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index')->with('success', 'Auto bolo odstránené zo zoznamu.');
    }
}