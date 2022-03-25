@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card-header">
                <h6>Winning Games</h6>
            </div>
            <hr>

            @if(\Auth::user()->email == "admin@betiq.pro")
                <a href="{{route('bet.create')}}">Create games</a><br>
            @endif

            <div class="row">
                @foreach($bets as $bet)
                <div class="col-md-4 col-xs-12 col-lf-4 col-sm-12">
                    <div class="card"> 
                        <div class="card-body">
                            <span><strong>{{$bet->league}}</strong></span><br>
                            <span>{{$bet->game_number}}: {{$bet->game}}</span><br>
                            <span>{{$bet->betting_comapy}}</span><br>
                            <span class="text-success">Bet: {{$bet->bet}}</span><br>
                            <span class="text-success">Bet Odd: {{$bet->odd}}</span>
                          
                            @if(\Auth::user()->email == "admin@betiq.pro")
                              <hr>
                            <form method="POST" action="{{route('bet.destroy',$bet->id)}}">
                              @csrf
                              @method('DELETE')
                              <button class="badge badge-danger">Remove</button>
                            </form>
                            @endif
                        </div>
                    </div>
                    <hr>
                </div>

                @endforeach
            </div>

       
        </div>
    </div>
</div>
@endsection
 