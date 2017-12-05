<?php

namespace App\Repositories\Frontend;

use App\Models\System\TimerSessions;

/**
 * Class TimerSessionsRepository.
 */
class TimerSessionsRepository extends BaseRepository
{
    /**
     * @param User $user
     * @param array $data
     *
     * @return mixed
     */
    public function clearSessionExceptCurrent(User $user, array $data)
    {
        //
    }
}
