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
