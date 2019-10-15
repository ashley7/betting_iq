<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\GameCode;
use App\UserTag;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

      if (\Auth::user()->email == "admin@betiq.pro") {

          $user_tags = UserTag::orderBy('id','DESC')->get();

      }else{
          $user_tags = UserTag::where('user_id',\Auth::user()->id)->orderBy('id','DESC')->get();
      }     

      $data = [

        'user_tags' => $user_tags

      ];

      return view('home')->with($data);

    }

    public static function grids($safeguard,$games,$amount,$tax)
    {
        // $safeguard = 2;
        // $games = array("Q001","Q002","Q003","Q004","Q005");
        $tickets = new Ticket($games, sizeof($games)-$safeguard);

        //End of Generate Tickets: Remember that these are the tickets you print in the pdf

        //This is the code that generates the grids that you show on the web app
        $totalNumberOfTickets = iterator_count($tickets);
        $tickets->rewind();

        for($i = 1; $i <= $safeguard; $i++)
        {
            //Generate Games Combination From 1 up to the safeguard number
            $gamesLost = new Ticket($games, $i);

          
            echo "<table border='1' class='table'>
                <caption>Grid ".$i.": If you loose ".$i." game(s)</caption>
            ";
            echo"<tr>
                   <th>If I loose Game Code</th>
                   <th>Total Amount Expected</th>
                   <th>Actual Amount to collect (".$tax."% tax)</th>
                </tr>";

            $numberOfGamesLost = iterator_count($gamesLost);

            $gamesLost->rewind();

            for($j = 0; $j < $numberOfGamesLost; $j++)
            {
                $gamesLostItem = $gamesLost->current();
                $gamesLost->next();
                $totalAmountExpected = 0;

                $tickets->rewind();

                for ($k = 0; $k < $totalNumberOfTickets; $k++)
                {
                    $ticketItem = $tickets->current();
                    $tickets->next();

                    //Check if that ticket contains the current game(s): If not, add the ticket amount and add it to total amount expected
                    if(!HomeController::ticketContainsGames($ticketItem, $gamesLostItem))
                    {
                        $totalAmountExpected += HomeController::getTotalAmount($ticketItem,$amount);
                    }
                }
                //Print the Grid Row
                echo"<tr>
                        <td>".HomeController::getGameCodes($gamesLostItem)."</td>
                        <td>".number_format($totalAmountExpected)."</td>
                        <td>".number_format($totalAmountExpected - ( ($tax/100) * $totalAmountExpected))."</td>
                    </tr>";
            }

            //Close the table
            echo "</table>";
            echo "<br/>";
        }
    }

       public static function getTotalAmount($ticket,$amount)
        {
           $sum_odds = 1;
           foreach ($ticket as $ticket_value) {
             $game_code = GameCode::where('game_code',$ticket_value)->where('tag',session('session'))->first(); 
             if (!empty($game_code)) {
                 if ($game_code->game_odd>0) {
                    $sum_odds = $sum_odds * $game_code->game_odd;
                } 
             }
           }

           return $sum_odds*$amount;
        }

       public static function ticketContainsGames($ticket, $games)
        {
            foreach ($games as $key => $value) {
                if(in_array($value, $ticket))
                {
                    return true;
                }
            }

            return false;
        }

        public static function getGameCodes($games)
        {
            //This function generates game codes in a way that is easy to read by separating them with commas
            return implode(" and ", $games);
        }

        public function failed_payments()
        {
           return view('faldtopay');
        }

        public function payments_made_well()
        {
          $user_tags = UserTag::where('user_id',\Auth::user()->id)->where('tag',session('session'))->get()->last();

          $user_tags->paid = "paid";

          $user_tags->save();

          return route('/home');
        }
}
