$(function () {

    const form = $('#payment-form')
    const formButton = $('#submit-form')

    form.on('submit', (e) => {
      e.preventDefault();
    })

    var button = $('#submit-form').on('click', function (e) {
      formButton.attr("disabled", "true");
      e.preventDefault();
      Stripe.setPublishableKey('pk_test_dKavGAc80Z0P36TPxlfVCssS');

      Stripe.createToken({
        number: $('.card-number').val(),
        cvc: $('.card-cvc').val(),
        exp_month: $('.card-expiry-month').val(),
        exp_year: $('.card-expiry-year').val(),
        currency: 'usd',
      }, function (status, response) {
        if (response.error) {
          
        } else {
          // token contains id, last4, and card type
          var token = response.id;
          if (token) {
            // insert the token into the form so it is sent to the server on submit.
            form.append($('<input type="hidden" name="stripeToken" />').val(token));
            form.get(0).submit();
          } else {
            
          }

        }
      });
    })

});
