@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card-header">
                <h6>STEP 2: Enter the safe Guard and the Betting amount for your ticket</h6>
            </div>
            <br>

            <div class="card"> 
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-hover">
                        <thead>
                            <th>Game code</th> <th>Type</th> <th>Odd</th>
                        </thead>

                        <tbody>
                            @foreach($game_code as $codes)
                              <tr>
                                  <td>{{$codes->game_code}}</td>
                                  <td>{{$codes->game_type}}</td>
                                  <td>{{$codes->game_odd}}</td>
                              </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <br><br>

                    <form method="POST" action="{{route('process_ticket.store')}}">
                        @csrf
                        <label>Safe Guard (No. of posible matches to loose)</label>
                        <input type="number" min="0" name="safeguards" class="form-control">

                        <label>Amount</label>
                        <input type="text" name="amount" class="form-control">

                        <label>Tax</label>
                        <input type="number" step="any" class="form-control" name="tax" value="15" min="0">

                        <br>
                        <button class="btn btn-success" id="btn_gen" type="submit">Generate codes</button>
                    </form>                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 