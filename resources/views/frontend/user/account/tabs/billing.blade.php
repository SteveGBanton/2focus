

@if ($logged_in_user->subscribedToPlan('zerosub2', 'main1'))
  <div>Card on file ends in {{ $logged_in_user->card_last_four }}.</div>
  <div>Replace current card:</div>
@else
  <div>No card on file. Please add a card:</div>
@endif

<form
    accept-charset="UTF-8"
    class="require-validation"
    id="payment-form"
    method="post"
    action="/billing/submit"
    enctype="multipart/form-data"
>

    {{ csrf_field() }}

    <div class="billing-form">
        <div>
            <input placeholder="Card Number" autocomplete="off" class="card-number" size="20" type="text">
        </div>
        <div class="billing-form-cvc-mo">
            <div>
                <input autocomplete="off" class="card-cvc" placeholder="CVC" size="4" type="text">
            </div>
            <div>
                <input
                    class="card-expiry-month" placeholder="MM" size="2"
                    type="text"
                >
            </div>
            <div>
                <input
                    class="card-expiry-year" placeholder="YYYY" size="4"
                    type="text"
                >
            </div>
             <div>
                <button 
                    id="submit-form"
                    type="submit"
                    class="submit-button"
                >
                    Submit
                </button>
            </div>
        </div>
    </div>
</form>