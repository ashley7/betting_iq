<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ticket = array();
        foreach(new Ticket(array('101','102','103','104','106'), 3) as $tickets){
            array_push($ticket, $tickets);
        }
       echo  count($ticket);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['odds'=>'required','amount'=>'required','safeguards'=>'required|numeric']);

        $original_ticket = explode(",",$request->odds);

        if ($request->safeguards == count($original_ticket)) {
            echo "Your Safe guard is equal to the Number of matches";
            return;
        }

        $tickets = array();   

        foreach(new Ticket(($original_ticket), count($original_ticket) - $request->safeguards) as $new_tickets){
            array_push($tickets,$new_tickets);
        }

        $data = ['tickets'=>$tickets,'amount'=>(str_replace(',','',$request->amount)/count($tickets)),'original_ticket'=>$original_ticket];

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
