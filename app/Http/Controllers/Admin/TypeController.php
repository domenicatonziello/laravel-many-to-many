<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use function PHPSTORM_META\type;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type = new Type();
        return view('admin.types.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:types|max:20',
            'color' => 'required|string|size:7'
        ], [
            'name.required' => 'Il nome è obbligatorio',
            'name.unique' => 'Esiste già un tipo di progetto con questo nome',
            'name.max' => 'Il tipo di progetto deve avere massimo :max caratteri',
            'color.required' => 'Il colore è obbligatorio',
            'color.size' => 'Il colore deve essere un codice esadecimale con cancelletto'
        ]);

        $data = $request->all();
        $type = new Type();

        $type->fill($data);
        $type->save();

        return to_route('admin.types.index')->with('type', 'success')->with('message', 'Elemento creato con successo');
    }
    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        return to_route('admin.types.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        $request->validate([
            'name' => ['required', 'string', Rule::unique('types')->ignore($type->id), 'max:20'],
            'color' => 'required|string|size:7'
        ], [
            'name.required' => 'Il nome è obbligatorio',
            'name.unique' => 'Esiste già un tipo di progetto con questo nome',
            'name.max' => 'Il tipo di progetto deve avere massimo :max caratteri',
            'color.required' => 'Il colore è obbligatorio',
            'color.size' => 'Il colore deve essere un codice esadecimale con cancelletto'
        ]);

        $data = $request->all();

        $type->fill($data);
        $type->save();

        return to_route('admin.types.index')->with('type', 'success')->with('message', 'Elemento modificato con successo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return to_route('admin.types.index')->with('type', 'danger')->with('message', "L'elemento è stato eliminato.");
    }
}
