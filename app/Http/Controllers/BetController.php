<?php

namespace App\Http\Controllers;

use App\Bet;
use App\User;
use Illuminate\Http\Request;

class BetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bets = Bet::get();

        $data = [
            'bets'=>$bets,
            'title'=>'Bet'
        ];

        return view('bets')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if(\Auth::user()->email != "admin@betiq.pro")

            return back()->with(['bad'=>'No Permissions']);

        $data = [
            'title'=>'Create a bet'
        ];

        return view('create_bet')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $saveBet = new Bet();        

        $saveBet->bet = $request->bet; 

        $saveBet->save();  

        $users = User::get()->pluck('email');

        $sms = "A new bet has been posted, please check it out on ".env('APP_NAME');

        User::sendEmail(env('MAIL_USERNAME'),"New Bet placed",$sms,env('MAIL_USERNAME'),"BET-IQ","BET-IQ Client",$users);

        return redirect()->route('bet.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bet  $bet
     * @return \Illuminate\Http\Response
     */
    public function show(Bet $bet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bet  $bet
     * @return \Illuminate\Http\Response
     */
    public function edit(Bet $bet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bet  $bet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bet $bet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bet  $bet
     * @return \Illuminate\Http\Response
     */
    public function destroy($bet)
    {
        Bet::destroy($bet);

        return redirect()->route('bet.index');
    }
}
