<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Part;
use App\Models\Car;

class PartController extends Controller
{
    public function index(Request $request)
    {
        $query = Part::query();
    
        // Filtrovanie podľa názvu dielu
        if ($request->has('search') && $request->get('search') != '') {
            $query->where('name', 'like', '%' . $request->get('search') . '%');
        }
    
        // Filtrovanie podľa auta
        if ($request->has('car_id') && $request->get('car_id') != '') {
            $query->where('car_id', $request->get('car_id'));
        }
    
        // Získanie všetkých dielov s filtrovaním a stránkovaním
        $parts = $query->with('car')->paginate(10);
    
        // Získanie všetkých áut pre výber vo filtrovaní
        $cars = Car::all();
    
        // Odoslanie do view (parts a cars)
        return view('parts.index', compact('parts', 'cars'));
    }

    public function create()
    {
        $cars = Car::all();
        return view('parts.create', compact('cars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'serialnumber' => 'required|unique:parts',
            'car_id' => 'required|exists:cars,id',
        ]);

        Part::create($request->all());
        return redirect()->route('parts.index')->with('success', 'Diel bol pridaný.');
    }

    public function edit(Part $part)
    {
        $cars = Car::all();
        return view('parts.edit', compact('part', 'cars'));
    }

    public function update(Request $request, Part $part)
    {
        $request->validate([
            'name' => 'required',
            'serialnumber' => 'required|unique:parts,serialnumber,' . $part->id,
            'car_id' => 'required|exists:cars,id',
        ]);

        $part->update($request->all());
        return redirect()->route('parts.index')->with('success', 'Diel bol aktualizovaný.');
    }

    public function destroy(Part $part)
    {
        $part->delete();
        return redirect()->route('parts.index')->with('success', 'Diel bol odstránený.');
    }
}
