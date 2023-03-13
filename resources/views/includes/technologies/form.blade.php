<hr>
@if($technology->exists)
    <form action="{{route('admin.technologies.update', $technology->id)}}" method="POST" novalidate enctype="multipart/form-data">
    @method('PUT')
@else
    <form action="{{route('admin.technologies.store')}}" method="POST" novalidate enctype="multipart/form-data">
@endif
    @csrf
    <div class="row my-5">
        {{-- label --}}
        <div class="col-3 mb-4">
            <label for="label" class="form-label">Nome</label>
            <input type="text" class="form-control @error('label') is-invalid @enderror" id="label" name="label" maxlength="20" required value="{{ old('label', $technology->label) }}" placeholder="Inserisci il nome">
            @error('label')
                <div class="invalid-feedback"> {{$message}} </div>
            @enderror
        </div>
        {{-- color --}}
        <div class="col-3 mb-4">
            <label for="color" class="form-label">Colore</label>
            <input type="color" class="form-control @error('color') is-invalid @enderror" id="color" name="color" maxlength="7" required value="{{ old('color', $technology->color) }}" placeholder="Inserisci il colore">
            @error('color')
                <div class="invalid-feedback"> {{$message}} </div>
            @enderror
        </div>
    </div>
    <a href="{{route('admin.technologies.index')}}" class="btn btn-secondary">Indietro</a>
    <button type="submit" class="btn btn-primary">Salva</button>
</form>
<hr>