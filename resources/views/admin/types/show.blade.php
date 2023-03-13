@extends('layouts.app')

@section('title', $project->title)

@section('content')
<div class="d-flex justify-content-center my-5">
    <div class="card m-3 px-0" style="width: 70%;">
        <img src="{{ asset('storage/'. $project->image) }}" class="card-img-top img-fluid" alt="{{ $project->title}}">
        <div class="card-body">
            <h5 class="card-title">{{ $project->title }}</h5>
            <p class="card-text"> {{$project->description }}</p>
            <p class="card-text">{{$project->type?->name}}</p>
            <a href="{{ $project->link_project}}" class="btn btn-primary">Vedi in GitHub</a>
            <a href="{{route('admin.projects.edit', $project->id)}}" class="btn btn-warning text-white">Modifica</a>
            <a href="{{route('admin.projects.index')}}" class="btn btn-secondary my-2">Indietro</a>
            <form action="{{route('admin.projects.destroy', $project->id)}}" method="POST" class="text-end delete-form">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger">Elimina</button>
            </form>
        </div>
    </div>
</div>
@endsection