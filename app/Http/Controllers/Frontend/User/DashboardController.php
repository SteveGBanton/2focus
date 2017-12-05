<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;

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
            'testdata' => [
                'test' => 'one',
                'two' => 'another one',
                'third' => 'third session',
            ],
            'moredata' => [
                'another', 'that', 'isnot', 'a named array'
            ],
            'nodata' => []
        ];
        
        return view('frontend.user.dashboard', $data);
    }
}
