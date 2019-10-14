<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<head>
  	<title></title>

  <style type="text/css">
    table, th, td {
       border: 1px solid black;
    }

  </style>
</head>

<body>  
               
  <p>
     Original Codes: [
        @foreach($original_ticket as $orig_ticket)
            {{$orig_ticket}},
        @endforeach]                    
  </p>

  @for($safeguards_count = 1;$safeguards_count <= $safeguards; $safeguards_count++)
      <br>
      <h3> Tickets at Safegurd of {{$safeguards_count}} matches lost</h3>

      <?php
        $tickets = array();
        $amount = 0;
        foreach(new App\Ticket($original_ticket, (count($original_ticket) - $safeguards_count)) as $new_tickets){
           array_push($tickets,$new_tickets);
         }
         $amount = $original_amount/count($tickets);
       ?>
       @foreach($tickets as $diffrent_options)
         <table class="table">                       
           <thead>
           	   <th>Game code</th> <th>Type</th> <th>Odd</th>
           </thead>
           
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
                  <tbody>
                     <tr> <td></td> <td></td><td> </td> </tr>
    	              	<tr> 
                        <td>{{$tickets}}</td>
                        <td>{{$game_code->game_type}}</td>
                        <td>{{$game_code->game_odd}}</td>
                      </tr> 
                </tbody>

                  <!-- <tr> <td></td> <td></td><td> </td> </tr> -->

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
	           <tr>
	           	<td>Benefit</td> <td>UGX: {{number_format((int)($sum_amount*1000))}}</td> <td><i>The multiplier factor was upgraded to 1,000</i></td>
	           </tr>                               
	             @else
	             <tr>
	             	<td>Benefit</td> <td></td> <td>UGX: {{number_format((int)($sum_amount*$amount))}}</td>
	             </tr>         
	        @endif
           <!-- </tbody> -->
       </table>
       <br>     
     @endforeach 
     @endfor  
 </body>      
</html>