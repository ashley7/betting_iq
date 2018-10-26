<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GameCode;
use App\Ticket;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $game_code = GameCode::where('tag',session('tag'))->get();
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
         $this->validate($request,['amount'=>'required','safeguards'=>'required|numeric']);

        $original_ticket = array();

        $game_code = GameCode::where('tag',session('tag'))->select('game_code')->get();
        foreach ($game_code as $key => $game_value) {
            array_push($original_ticket, $game_value->game_code);
        }

        if ($request->safeguards == count($original_ticket)) {
            echo "Your Safe guard is equal to the Number of matches";
            return;
        }

        $tickets = array();   

        foreach(new Ticket($original_ticket, (count($original_ticket) - $request->safeguards)) as $new_tickets){
            array_push($tickets,$new_tickets);
        }

        $data = ['tickets'=>$tickets,'amount'=>(str_replace(',','',$request->amount)/count($tickets)),'original_ticket'=>$original_ticket];

        $pdf = \PDF::loadView('pdf',$data)->setPaper('legal', 'portrait')->save(public_path().'/tickets/tickets_'.session('tag').'.pdf');
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
        //
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
}
