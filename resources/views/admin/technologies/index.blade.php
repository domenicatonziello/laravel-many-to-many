@extends('layouts.app')

@section('title', 'Tecnologie')

@section ('content')
    <div class="d-flex justify-content-between align-items-center my-5">
        <h1 class="">Tecnologie </h1>
        <a href="{{route('admin.tecnologies.create')}}" class="btn btn-success">Aggiungi</a>
    </div>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Label</th>
            <th scope="col">Colore</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($technologies as $technology)
                <tr>
                    <th scope="row">{{$technology->id}}</th>
                    <td>{{$technology->label}}</td>
                    <td>{{$technology->color}}</td>
                    <td class="text-end">
                        <a href="{{route('admin.technologies.show', $technology->id)}}" class="btn btn-primary">Dettagli</a>
                        <form action="{{route('admin.technologies.destroy', $technology->id)}}" method="POST" class="d-inline delete-form">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Elimina</button>
                        </form>
                        <a href="{{route('admin.technologies.edit', $technology->id)}}" class="btn btn-warning text-white">Modifica</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
@endsection