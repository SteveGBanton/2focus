<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Auth\User;
use Symfony\Component\Console\Output\ConsoleOutput;

/**
 * Class BillingController.
 */
class BillingController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function storePayment(Request $request)
    {
        $stripeToken = $request->stripeToken ?? false;

        info($request);
        
        $user = User::find(auth()->user()->id);

        info($user);

        if ($user->subscribed('main1')) {
            $user->subscription('main1')->cancelNow();
        }

        $user->newSubscription('main1', 'zerosub2')->create($stripeToken);

        // if ($user->subscribed('main')) {
        //     $user->updateCard($stripeToken);
        // } else {
        //     $user->newSubscription('main', 'zerosubdaily')->create($stripeToken);
        // }

        return redirect()->route('frontend.user.account')->withFlashSuccess(__('strings.frontend.user.billing_updated'));
    }
}
