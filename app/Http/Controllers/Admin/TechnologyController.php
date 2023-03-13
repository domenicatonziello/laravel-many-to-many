<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::all();
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $technology = new Technology();
        return view('admin.technologies.create', compact('technology'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|unique:types|max:20',
            'color' => 'required|string|size:7'
        ], [
            'label.required' => 'Il nome è obbligatorio',
            'label.unique' => 'Esiste già una tecnologia con questo nome',
            'label.max' => 'Il nome deve avere massimo :max caratteri',
            'color.required' => 'Il colore è obbligatorio',
            'color.size' => 'Il colore deve essere un codice esadecimale con cancelletto'
        ]);

        $data = $request->all();
        $technology = new Technology();

        $technology->fill($data);
        $technology->save();

        return to_route('admin.technologies.show', $technology->id)->with('type', 'success')->with('message', 'Elemento creato con successo');
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        return to_route('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Technology $technology)
    {
        $request->validate([
            'label' => ['required', 'string', Rule::unique('technologies')->ignore($technology->id), 'max:20'],
            'color' => 'required|string|size:7'
        ], [
            'label.required' => 'Il nome è obbligatorio',
            'label.unique' => 'Esiste già una tecnologia con questo nome',
            'label.max' => 'Il nome deve avere massimo :max caratteri',
            'color.required' => 'Il colore è obbligatorio',
            'color.size' => 'Il colore deve essere un codice esadecimale con cancelletto'
        ]);

        $data = $request->all();

        $technology->fill($data);
        $technology->save();

        return to_route('admin.technologies.show', $technology->id)->with('type', 'success')->with('message', 'Elemento modificato con successo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return to_route('admin.technologies.index')->with('type', 'danger')->with('message', "L'elemento è stato eliminato.");
    }
}
