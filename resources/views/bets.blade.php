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
                <a href="{{route('bet.create')}}" class="btn btn-success">Create games</a><br><br>
            @endif

            <div class="row">
                @foreach($bets as $bet)
                <div class="col-md-4 col-xs-12 col-lf-4 col-sm-12">
                    <div class="card"> 
                        <div class="card-body">                           
                            <span class="text-success"><?php echo $bet->bet ?></span>

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
 