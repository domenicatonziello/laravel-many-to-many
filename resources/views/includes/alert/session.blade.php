{{-- ALERT --}}
@if(session('message'))
<div class="alert alert-{{session('type')}} my-5" role="alert">
    {{session('message')}}
</div>
@endif