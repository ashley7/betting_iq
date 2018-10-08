@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h2>Possible Winning tickets</h2>

                Original Codes: {

                @foreach($original_ticket as $orig_ticket)
                    {{$orig_ticket}},
                @endforeach

            }

                <div class="card-body">
                  @foreach($tickets as $diffrent_options)
                     @foreach($diffrent_options as $tickets)
                        {{$tickets}} - 
                     @endforeach

                     @ UGX {{(int)$amount}}

                     <br><br>
                  @endforeach                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection