

@if ($logged_in_user->subscribedToPlan('zerosub2', 'main1'))
  <div>SUBSCRIBED!</div>
@else
  <div>NOT SUBSCRIBED!</div>
@endif

    <button id="testbutton">Click Here</button>

<form
    accept-charset="UTF-8"
    class="require-validation"
    id="payment-form"
    method="post"
    action="/billing/submit"
    enctype="multipart/form-data"
>

    {{ csrf_field() }}

    <div class='form-row'>
        <div class='col-xs-12 form-group required'>
            <label class='control-label'>Name on Card</label> 
            <input id="name-get" class='form-control' size='4' type='text'>
        </div>
    </div>
    <div class='form-row'>
        <div class='col-xs-12 form-group card required'>
            <label class='control-label'>Card Number</label>
            <input autocomplete='off' class='form-control card-number' size='20' type='text'>
        </div>
    </div>
    <div class='form-row'>
        <div class='col-xs-4 form-group cvc required'>
            <label class='control-label'>CVC</label>
            <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
        </div>
        <div class='col-xs-4 form-group expiration required'>
            <label class='control-label'>Expiration</label>
            <input
                class='form-control card-expiry-month' placeholder='MM' size='2'
                type='text'>
        </div>
        <div class='col-xs-4 form-group expiration required'>
            <label class='control-label'> </label>
            <input
                class='form-control card-expiry-year' placeholder='YYYY' size='4'
                type='text'>
        </div>
    </div>
    <div class='form-row'>
        <div class='col-md-12'>
            <div class='form-control total btn btn-info'>
                Total: <span class='amount'>$300</span>
            </div>
        </div>
    </div>
    <div class='form-row'>
        <div class='col-md-12 form-group'>
            <button id="submit-form" class='form-control btn btn-primary submit-button'
                type='submit' style="margin-top: 10px;">Pay »</button>
        </div>
    </div>
    <div class='form-row'>
        <div class='col-md-12 error form-group hide'>
            <div class='alert-danger alert'>Please correct the errors and try
                again.</div>
        </div>
    </div>
</form>