<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\GameCode;
use App\Ticket;
use App\UserTag;
use App\Http\Controllers\ProcessTicketsController;

class ProcessTicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


    }

    public function get_tickets_folder()
    {
        //check if directory exists, else create it
        $ticketFolder = public_path().'/tickets';

        if (!File::exists($ticketFolder)) {
            File::makeDirectory($ticketFolder);
        }

        return $ticketFolder;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $game_code = GameCode::where('tag',session('session'))->get();
        if ($game_code->count() == 0) {
            return back()->with(['status'=>'You have no games.']);
        }
        return view('generate_tickets')->with(['game_code'=>$game_code]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['amount'=>'required','safeguards'=>'required|numeric','tax'=>'required']);         

        $original_ticket = array();
        $tickets = array();

        $user_tags = UserTag::where('user_id',\Auth::user()->id)->where('tag',session('session'))->get()->last();

        $user_tags->safe_guard = $request->safeguards;
        $user_tags->amount = $request->amount;
        $user_tags->tax = (int)$request->tax;

        $user_tags->save();

        $game_code = GameCode::where('tag',session('session'))->select('game_code')->get();
        foreach ($game_code as $key => $game_value) {
            array_push($original_ticket, $game_value->game_code);
        }

        if ($request->safeguards == count($original_ticket)) {
            echo "Your Safe guard is equal to the Number of matches";
            return;
        }

        foreach(new Ticket($original_ticket, (count($original_ticket) - $request->safeguards)) as $new_tickets){

            array_push($tickets,$new_tickets);
            
        }

        $data = ['out_put_tickets'=>$tickets,'amount'=>(str_replace(',','',$request->amount)/count($tickets)),'original_ticket'=>$original_ticket,'safeguards'=>$request->safeguards,'tax'=>$request->tax];

        $ticketFolder = ProcessTicketsController::get_tickets_folder();

        $pdf = \PDF::loadView('pdf',$data)->setPaper('legal', 'A4')->save($ticketFolder.'/tickets_'.session('session').'.pdf');
        // return $pdf->download('tickets_'.time().'.pdf'); 
        return view('newtickets')->with($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request,['amount'=>'required','safeguards'=>'required|numeric']);

        $original_ticket = array();
        $tickets = array();
        $safeguards = $request->safeguards;

        $game_code = GameCode::where('tag',session('session'))->select('game_code')->get();
        foreach ($game_code as $key => $game_value) {
            array_push($original_ticket, $game_value->game_code);
        }

        if ($safeguards == count($original_ticket)) {
            echo "Your Safe guard is equal to the Number of matches";
            return;
        }       

        $data = ['original_amount'=>(str_replace(',','',$request->amount)),'original_ticket'=>$original_ticket,'safeguards'=>$safeguards];

        $ticketFolder = get_tickets_folder();

        $pdf = \PDF::loadView('pdf_blade',$data)->setPaper('legal', 'portrait')->save($ticketFolder.'/tickets_'.session('session').'.pdf');
 
        return view('newtickets_multipal')->with($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    } 

    public function randomAccessTickets($tag_id)
    {

        session(['session'=>$tag_id]);

        $user_tags = UserTag::where('user_id',\Auth::user()->id)->where('tag',$tag_id)->get()->last();

        $original_ticket = array();
        $tickets = array();

        $game_code = GameCode::where('tag',$tag_id)->select('game_code')->get();

        foreach ($game_code as $key => $game_value) {
            array_push($original_ticket, $game_value->game_code);
        }

        if ($user_tags->safe_guard == count($original_ticket)) {
            echo "Your Safe guard is equal to the Number of matches";
            return;
        }

        foreach(new Ticket($original_ticket, (count($original_ticket) - $user_tags->safe_guard)) as $new_tickets){

            array_push($tickets,$new_tickets);
            
        }

        $data = ['out_put_tickets'=>$tickets,'amount'=>(str_replace(',','',$user_tags->amount)/count($tickets)),'original_ticket'=>$original_ticket,'safeguards'=>$user_tags->safe_guard,'tax'=>$user_tags->tax];
       
        return view('newtickets')->with($data);
    }

}
