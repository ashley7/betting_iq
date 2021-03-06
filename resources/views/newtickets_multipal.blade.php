@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
           <div class="card-header"><h2> Possible Winning tickets</h2></div>
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

                  <a  class="btn btn-success" style="float: right;" href="{{asset('tickets')}}/{{$my_ticket}}">Download Tickets</a>
               

            
              @for($safeguards_count = 1;$safeguards_count <= $safeguards; $safeguards_count++)
                <br><br>
                <h3> At Safegurd of {{$safeguards_count}} matches lost</h3>
              <?php
                $tickets = array();
                $amount = 0;
                foreach(new App\Ticket($original_ticket, (count($original_ticket) - $safeguards_count)) as $new_tickets){
                   array_push($tickets,$new_tickets);
                 }
                 $amount = $original_amount/count($tickets);
               ?>

               <div class="row">
                  @foreach($tickets as $diffrent_options)
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
                             <caption>UGX: {{number_format((int)($sum_amount*$amount))}}</caption>
                          @endif
                      </div>                 
                    @endforeach
                  </div>
                  @endfor                  
                </div>
             </div>                 
          </div>
    </div>
</div>
@endsection