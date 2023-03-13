<hr>
@if($type->exists)
    <form action="{{route('admin.types.update', $type->id)}}" method="POST" novalidate enctype="multipart/form-data">
    @method('PUT')
@else
    <form action="{{route('admin.types.store')}}" method="POST" novalidate enctype="multipart/form-data">
@endif
    @csrf
    <div class="row my-5">
        {{-- name --}}
        <div class="col-3 mb-4">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" maxlength="20" required value="{{ old('name', $type->name) }}" placeholder="Inserisci il nome">
            @error('name')
                <div class="invalid-feedback"> {{$message}} </div>
            @enderror
        </div>
        {{-- color --}}
        <div class="col-3 mb-4">
            <label for="color" class="form-label">Colore</label>
            <input type="color" class="form-control @error('color') is-invalid @enderror" id="color" name="color" maxlength="7" required value="{{ old('color', $type->color) }}" placeholder="Inserisci il colore">
            @error('color')
                <div class="invalid-feedback"> {{$message}} </div>
            @enderror
        </div>
    </div>
    <a href="{{route('admin.types.index')}}" class="btn btn-secondary">Indietro</a>
    <button type="submit" class="btn btn-primary">Salva</button>
</form>
<hr>