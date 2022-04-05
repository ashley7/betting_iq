@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card-header">
                <h6>Winning Games</h6>
            </div>
            <br>

            <div class="card"> 
                <div class="card-body">  

                <form method="POST" action="{{route('bet.store')}}">
                    @csrf                  

                    <label>Bet Detail</label>
                    <textarea name="bet" class="form-control"></textarea>          

                    <hr>
                    <button class="btn btn-success" type="submit">Save</button>
                </form>           
                

               
                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts') 

<script src="https://cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
         CKEDITOR.replace( 'bet' );
    
    });
</script>

@endpush
 