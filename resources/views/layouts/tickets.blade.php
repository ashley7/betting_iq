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