@extends('layouts.app')

@section('title', 'Progetti')

@section ('content')
    <div class="d-flex justify-content-between align-items-center my-5">
        <h1 class="">Progetti</h1>
        <a href="{{route('admin.projects.create')}}" class="btn btn-success">Aggiungi</a>
    </div>
    <div class="row">
        @forelse ($projects as $project)
            <div class="col-4 my-3">
                <div class="card h-100">
                    <div class="card-image">
                        <img src="{{ asset('storage/'. $project->image) }}" class="card-img-top img-fluid" alt="{{ $project->title}}">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $project->title }}</h5>
                        <p class="card-text"> {{$project->description }}</p>
                        <div class="mt-auto">
                            <a href="{{route('admin.projects.show', $project->id)}}" class="btn btn-primary">Dettagli</a>
                            <form action="{{route('admin.projects.destroy', $project->id)}}" method="POST" class="d-inline delete-form">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Elimina</button>
                            </form>
                            <a href="{{route('admin.projects.edit', $project->id)}}" class="btn btn-warning text-white">Modifica</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <h2>Non ci sono progetti</h2>
        @endforelse
    </div>
@endsection