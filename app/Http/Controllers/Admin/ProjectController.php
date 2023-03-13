<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $project = new Project();
        $types = Type::all();
        return view('admin.projects.create', compact('project', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:projects|max:50',
            'description' => 'string|nullable',
            'image' => 'image|nullable',
            'link_project' => 'required|string|unique:projects',
            'type_id' => 'nullable|exists:types,id'
        ], [
            'title.required' => 'il titolo è obbligatorio',
            'title.max' => 'il titolo deve avere massimo 50 caratteri',
            'title.unique' => "Esiste già un progetto $request->title ",
            'link_project.required' => 'Il link per il progetto è obbligatorio',
            'link_project.unique' => 'Link già esistente',
            'type_id' => 'Il tipo selezionato non è valido'
        ]);
        $data = $request->all();
        $project = new Project();

        // controllo se nell'array ho l'immagine
        if (array_key_exists('image', $data)) {
            // prendo l'url dell'immagine
            $img_url = Storage::put('projects', $data['image']);
            // sostituisco url all'immagine
            $data['image'] = $img_url;
        }

        $project->fill($data);
        $project->save();

        return to_route('admin.projects.show', $project->id)->with('type', 'success')->with('message', 'Elemento creato con successo');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        return view('admin.projects.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => ['required', 'string', Rule::unique('projects')->ignore($project->id), 'max:50'],
            'description' => 'string|nullable',
            'image' => 'image|nullable',
            'link_project' => ['required', 'string', Rule::unique('projects')->ignore($project->id)],
            'type_id' => 'nullable|exists:types,id'
        ], [
            'title.required' => 'il titolo è obbligatorio',
            'title.max' => 'il titolo deve avere massimo 50 caratteri',
            'title.unique' => "Esiste già un progetto $request->title ",
            'link_project.required' => 'Il link per il progetto è obbligatorio',
            'link_project.unique' => 'Link già esistente',
            'type_id' => 'Il tipo selezionato non è valido'
        ]);
        $data = $request->all();

        // controllo se ho già l'immagine e la elimino
        if ($project->image) Storage::delete($project->image);
        // controllo se nell'array ho l'immagine
        if (array_key_exists('image', $data)) {
            // prendo l'url dell'immagine
            $img_url = Storage::put('projects', $data['image']);
            // sostituisco url all'immagine
            $data['image'] = $img_url;
        }

        $project->update($data);

        return to_route('admin.projects.show', $project->id)->with('type', 'success')->with('message', 'Progetto modificato con successo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // controllo se ho già l'immagine e la elimino
        if ($project->image) Storage::delete($project->image);

        $project->delete();
        return to_route('admin.projects.index')->with('type', 'danger')->with('message', "Il progetto '$project->title' è stato eliminato.");
    }
}
