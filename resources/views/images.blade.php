@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Resize images</h2>
            <div class="card">
                 <form method="POST" action="/resize_photoes" enctype="multipart/form-data" style="padding: 10px;">
                    @csrf
                     <label>Width</label>
                     <input type="number" name="width" class="form-control">

                     <label>Height</label>
                     <input type="number" name="height" class="form-control">
                     <br>
                     <input type="file" multiple="multiple" name="photo[]">
                     <br><br>
                     <button type="submit">Resize</button>
                 </form>
            </div>
        </div>
    </div>
</div>
@endsection