@extends('layouts.app')

@section('content')

      @php
        $user_tags = App\UserTag::where('user_id',Auth::user()->id)->where('tag',session('session'))->get()->last();
      @endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
           <div class="card-header"><h2>{{count($out_put_tickets)}} Possible Winning tickets</h2></div>
           <br>
              <div class="card">
                <div class="card-body">
                  <p>
                     Original Codes: [
                        @foreach($original_ticket as $orig_ticket)
                            {{$orig_ticket}},
                        @endforeach]                    
                  </p>

                  @php

                    $my_ticket = "tickets_".session('session').".pdf";

                    $number_of_tickets = App\Http\Controllers\TicketController::numberOfTickets();

                  @endphp

                  @if($number_of_tickets < 6)
                    <a class="btn btn-success" style="float: right;" href="{{asset('tickets')}}/{{$my_ticket}}">Download your tickets</a>
                  @else

                    @if($user_tags->paid == "paid")

                      <a class="btn btn-success" style="float: right;" href="{{asset('tickets')}}/{{$my_ticket}}">Download your tickets</a>

                      @else                      

                        <form>
                            <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
                            <button type="button" class="btn btn-success" onClick="payWithRave()">Pay UGX 500 to download the Winning tickets</button>
                        </form> 

                    @endif


                  @endif
                  <br><br>
            <div class="row">
              @php
                  App\Http\Controllers\HomeController::grids($safeguards,$original_ticket,$amount,$tax);
              @endphp
            </div>
        </div>
      </div>

      <br><br>

      @if($number_of_tickets < 6)

        @include('layouts.tickets')

        @else

          @if($user_tags->paid == "paid")

             @include('layouts.tickets')

          @endif
      @endif

          </div>
    </div>
</div>
@endsection

@section('styles')

  <style>
    #tickets{
      display: none;
    }
  </style>

@endsection

@push('scripts')

  <script>
    const API_publicKey = "{{ env('FLPUBK') }}";

    function payWithRave() {
        var x = getpaidSetup({
            PBFPubKey: API_publicKey,
            customer_email: "{{Auth::user()->email}}",
            amount: 1000,
            customer_phone: "{{Auth::user()->phone_number}}",
            currency: "UGX",
            txref: "rave-{{time()}}", 
            
            onclose: function() {
               window.location = "/failed_payments";
            },
            callback: function(response) {
              window.location = "/payments_made_well";                
              //x.close();   
            }

        });
    }
  </script>
@endpush

