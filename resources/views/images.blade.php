@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                 <form method="POST" action="/resize_photoes" enctype="multipart/form-data">
                    @csrf
                     <input type="file" multiple="multiple" name="photo[]">
                     <button type="submit">Resize</button>
                 </form>
            </div>
        </div>
    </div>
</div>
@endsection