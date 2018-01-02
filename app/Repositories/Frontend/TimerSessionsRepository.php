<?php

namespace App\Repositories\Frontend;

use App\Models\System\TimerSessions;

/**
 * Class TimerSessionsRepository.
 */
class TimerSessionsRepository extends BaseRepository
{
    /**
    * @return string
    */
    public function model()
    {
        return TimerSessions::class;
    }

    public function store(array $data)
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
    
    // /**
    //  * @param User $user
    //  * @param array $data
    //  *
    //  * @return mixed
    //  */
    // public function addSession(User $user, array $data)
    // {
    //     //
    // }
}
