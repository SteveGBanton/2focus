<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\System\TimerSessions;
use Illuminate\Http\Request;

class TimerSessionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userSessions = TimerSessions::all();
        return $userSessions;
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
        $user = auth()->user();
        info($request);
        $this->validate($request, [
            'target_length' => 'required|numeric',
            'focused_length' => 'required|numeric',
            'success' => 'required|boolean',
        ]);
        
        $user_billable = ($user->subscribed('main1')) ?? false;
        $bill_amt = 0; // Assumes successful session
        
        if ($request->success == false && $user_billable == true) {
            $bill_amt = $user->billAmt ?? 200;
            $user->invoiceFor('Focus failure', $bill_amt);
        };

        return TimerSessions::create([ 
            'target_length' => request('target_length'),
            'focused_length' => request('focused_length'),
            'success' => request('success'),
            'bill_amt' => ($bill_amt/100),
            'client_id' => $user->id,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TimerSessions  $timerSessions
     * @return \Illuminate\Http\Response
     */
    public function show(TimerSessions $timerSessions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TimerSessions  $timerSessions
     * @return \Illuminate\Http\Response
     */
    public function edit(TimerSessions $timerSessions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TimerSessions  $timerSessions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TimerSessions $timerSessions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TimerSessions  $timerSessions
     * @return \Illuminate\Http\Response
     */
    public function destroy(TimerSessions $timerSessions)
    {
        // timerSession = TimerSessions::
    }
}
