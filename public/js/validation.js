$(function () {

    var form = $('#payment-form')

    form.on('submit', (e) => {
      e.preventDefault();
    })

    var button = $('#submit-form').on('click', function (e) {
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
          console.log('error' + response.error)
        } else {
          console.log(response.id);
          // token contains id, last4, and card type
          var token = response.id;
          if (token) {
            // insert the token into the form so it gets submitted to the server
            form.append($('<input type="hidden" name="stripeToken" />').val(token));
            form.get(0).submit();
          } else {
          }

        }
      });
    })

});
