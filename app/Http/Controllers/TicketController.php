<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\UserTag;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //  $ticket = array();
       //  foreach(new Ticket(array('101','102','103','104','106'), 3) as $tickets){
       //      array_push($ticket, $tickets);
       //  }
       // echo  count($ticket); 

        $save_user_tag = new UserTag();
        $save_user_tag->tag = time();
        $save_user_tag->user_id = \Auth::user()->id;
        $save_user_tag->save();
        session(['session'=>$save_user_tag->tag]);
      
        return view('ticket');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("images");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function resize_photoes(Request $request)
    {   
        $count = 0;
        foreach ($request->file('photo') as $image_files) {    
            $image_name=$count.'_'.time().'.'.$image_files->getClientOriginalExtension();
            $destination=public_path('images/'.$image_name);
            \Image::make($image_files)->resize($request->width,$request->height)->save($destination);
            $count++;
        }                    
    }  


    public static function numberOfTickets()
    {
        UserTag::where('user_id',\Auth::user()->id)->where('safe_guard',0)->delete();
        return UserTag::where('user_id',\Auth::user()->id)->get()->count();    
    }
}
