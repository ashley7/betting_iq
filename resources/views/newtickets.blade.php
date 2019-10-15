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
                  @endphp

                  <a class="btn btn-success" style="float: right;" href="{{asset('tickets')}}/{{$my_ticket}}">Download your tickets</a>
                  <br><br>
            <div class="row">
              @php
                  App\Http\Controllers\HomeController::grids($safeguards,$original_ticket,$amount,$tax);
              @endphp
            </div>
        </div>
      </div>

      <br><br>

     

      @if($user_tags->paid == "not paid")

      <i>Pay UGX 1000 to download the winning tickets</i>

      <form>
          <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
          <button type="button" class="btn btn-success" onClick="payWithRave()">Pay to download the tickets</button>
      </form> 

      @elseif($user_tags->paid == "paid") 

      <div class="card">
          <div class="card-body">
              <div class="row">
                  @foreach($out_put_tickets as $diffrent_options)
                    <div class="col-md-4 col-xs-12 col-sm-12 col-lg-4 ">

                         <table border="2" class="table table-hover">
                         
                            @if($amount < 1000)
                             <caption>Bet amount UGX: 1,000</caption>                       
                             @else
                             <caption>Bet amount UGX: {{number_format(round((double)$amount))}}</caption>
                            @endif
                                                
                           <th>Game code</th> <th>Type</th> <th>Odd</th>


                           <?php $sum_amount = 1; ?>
                            @foreach($diffrent_options as $tickets)
                            <?php

                               $game_code = App\GameCode::where('game_code',$tickets)->where('tag',session('session'))->first(); 
                             ?>
                              @if(!empty($game_code))
                              <?php 
                                  if ($game_code->game_odd>0) {
                                     $sum_amount = $sum_amount * $game_code->game_odd;
                                  }                                
                               ?>
                              <tr>
                                <td>{{$tickets}}</td>
                                <td>{{$game_code->game_type}}</td>
                                <td>{{$game_code->game_odd}}</td>
                              </tr>
                              @endif                              
                            @endforeach
                            <tr>
                              <td>Total</td> <td></td> <td>{{$sum_amount}}</td>
                            </tr>                           
                          </table>
                          @if($amount < 1000)
                             <caption>UGX: {{number_format((int)($sum_amount*1000))}}</caption> (<i>The multiplier factor was upgraded to 1,000</i>)                             
                             @else

                             <?php
                               $total_amount = $sum_amount*$amount;
                              ?>
                             <caption>UGX: {{number_format((int)($total_amount))}}  | Actual UGX: {{number_format($total_amount - ($tax/100 * $total_amount))}} ({{$tax}}% tax)</caption>
                          @endif
                      </div>                 
                    @endforeach 
                  </div> 
                </div>
             </div> 

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
              x.close();   
            }

        });
    }
  </script>
@endpush

