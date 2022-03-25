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
                    <label>League Name</label>
                    <input type="text" name="league" class="form-control">

                    <label>Game</label>
                    <input type="text" name="game" class="form-control">

                    <label>Game Number</label>
                    <input type="text" name="game_number" class="form-control">

                    <label>Betting comapy</label>
                    <input type="text" name="betting_comapy" class="form-control">

                    <label>Bet</label>
                    <input type="text" name="bet" class="form-control">

                    <label>Odd</label>
                    <input type="text" name="odd" class="form-control">

                    <hr>
                    <button class="btn btn-success" type="submit">Save</button>
                </form>           
                

               
                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 