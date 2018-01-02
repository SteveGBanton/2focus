<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\System\TimerSessions;
use Illuminate\Support\Facades\Input;

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
        $page = (Input::get('page') * 20) ?? 0;
        $number = TimerSessions::where('client_id', auth()->user()->id)->count();
        $data = [
            'timerSessions' => TimerSessions::where('client_id', auth()->user()->id)->orderBy('id', 'desc')->take(20)->skip($page)->get(),
            'page' => (($page >= 20) ? ($page / 20) : 0),
            'number' => $number
        ];
        return view('frontend.user.dashboard', $data);
    }
}