<?php

namespace App\Http\Controllers;

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
        return TimerSessions::latest()->get();
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
        $this->validate($request, [
            'target_length' => 'required|numeric',
            'focus_length' => 'required|numeric',
            'success' => 'required|boolean',
        ]);
        
        $user_billable = (auth()->user()->hasCreditOnFile) ?? false;
        $bill_amt = 0;
        
        if ($request->success == false && $user_billable == true) {
            $bill_amt = auth()->user()->billAmt ?? 2;
        };

        return TimerSessions::create([ 
            'target_length' => request('target_length'),
            'focus_length' => request('focus_length'),
            'success' => request('success'),
            'bill_amt' => $bill_amt,
            'client_id' => auth()->user()->id,
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
