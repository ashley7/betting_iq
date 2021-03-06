<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<head>
	<title></title>

  <style type="text/css">
     thead:before, thead:after { display: none; }
     tbody:before, tbody:after { display: none; }
 </style>
</head>

<body>
  <h2>{{count($out_put_tickets)}} Possible Winning tickets</h2> 
               
  <p>
     Original Codes: [
        @foreach($original_ticket as $orig_ticket)
            {{$orig_ticket}},
        @endforeach]                    
  </p>
      @foreach($out_put_tickets as $diffrent_options)
        <table border="2">                       
           <thead>
           	   <th>Game code</th> <th>Type</th> <th>Odd</th>
           </thead> 

           <tbody>
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
                  <tr> <td></td> <td></td><td> </td> </tr>
	              	<tr> <td>{{$tickets}}</td> <td>{{$game_code->game_type}}</td> <td>{{$game_code->game_odd}}</td> </tr> 

	              @endif
            @endforeach
            <tr>
              <td>Total</td> <td></td> <td>{{$sum_amount}}</td>
            </tr> 

            @if($amount < 1000)
            <tr>
            	<td>Bet amount</td> <td></td> <td>UGX: 1,000</td>
            </tr>
                                
             @else
             <tr>
             	<td>Bet amount</td> <td></td> <td>UGX: {{number_format(round((double)$amount))}}</td>
             </tr>          
            @endif

	        @if($amount < 1000)

          <?php
            $total_amount = $sum_amount*1000;

           ?>
	           <tr>
	           	<td>Benefit</td> <td>UGX: {{number_format((int)($total_amount))}} Actual {{number_format($total_amount - ($tax/100 * $total_amount))}} ({{$tax}}% tax)</td> <td><i>The multiplier factor was upgraded to 1,000</i></td>
	           </tr>                               
	             @else
                <?php
                  $total_amount = $sum_amount*$amount;
                 ?>
	             <tr>
	             	<td>Benefit</td> <td></td> <td>UGX: {{number_format((int)($total_amount))}} Actual {{number_format($total_amount - ($tax/100 * $total_amount))}} ({{$tax}}% tax)</td>
	             </tr>         
	        @endif
           </tbody>
       </table>          
     @endforeach   
 </body>      
</html>