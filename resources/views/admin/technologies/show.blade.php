@extends('layouts.app')

@section('title', $technology->label)

@section('content')
<div class="d-flex justify-content-center my-5">
    <div class="card m-3 px-0" style="width: 70%;">
        <div class="card-body">
            <h5 class="card-title">{{ $technology->label }}</h5>
            <p class="card-text">{{$technology->color}}</p>
            <a href="{{route('admin.technologies.edit', $technology->id)}}" class="btn btn-warning text-white">Modifica</a>
            <a href="{{route('admin.technologies.index')}}" class="btn btn-secondary my-2">Indietro</a>
            <form action="{{route('admin.technologies.destroy', $technology->id)}}" method="POST" class="text-end delete-form">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger">Elimina</button>
            </form>
        </div>
    </div>
</div>
@endsection