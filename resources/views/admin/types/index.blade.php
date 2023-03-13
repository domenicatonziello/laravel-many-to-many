@extends('layouts.app')

@section('title', 'Tipi di Progetti')

@section ('content')
    <div class="d-flex justify-content-between align-items-center my-5">
        <h1 class="">Tipi di progetto </h1>
        <a href="{{route('admin.types.create')}}" class="btn btn-success">Aggiungi</a>
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
            @foreach ($types as $type)
                <tr>
                    <th scope="row">{{$type->id}}</th>
                    <td>{{$type->name}}</td>
                    <td>{{$type->color}}</td>
                    <td class="text-end">
                        <form action="{{route('admin.types.destroy', $type->id)}}" method="POST" class="d-inline delete-form">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Elimina</button>
                        </form>
                        <a href="{{route('admin.types.edit', $type->id)}}" class="btn btn-warning text-white">Modifica</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
@endsection