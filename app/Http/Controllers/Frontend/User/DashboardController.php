<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\System\TimerSessions;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = [
            'timerSessions' => TimerSessions::where('client_id', auth()->user()->id)->orderBy('id', 'desc')->get()
        ];
        return view('frontend.user.dashboard', $data);
    }
}
