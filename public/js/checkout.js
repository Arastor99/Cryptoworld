document.addEventListener("alpine:init", () => {
    Alpine.data("creditCard", () => ({
        init() {
        },
        format() {
            if (this.cardNumber.length > 18) {
                return;
            }
            this.cardNumber = this.cardNumber.replace(/\W/gi, '').replace(/(.{4})/g, '$1 ');
        },
        get isValid() {
            if (this.cardholder.length < 5) {
                return false;
            }
            if (this.cardNumber === '') {
                return false;
            }
            if (this.expired.month === '' && this.expired.year === '') {
                return false;
            }
            if (this.securityCode.length !== 3) {
                return false;
            }
            return true;
        },
        onSubmit(e) {
            e.preventDefault()
        },
        cardholder: '',
        cardNumber: '',
        expired: {
            month: '',
            year: '',
        },
        securityCode: '',
        card: 'front',
    }));
});

$(function() {
    function stripeResponseHandler(status, response) {
        var $form = $(".require-validation");
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            var token = response['id'];
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
    $('form').submit(function(e) {
        e.preventDefault();
        var $form = $(".require-validation");
        Stripe.setPublishableKey($form.data('stripe-publishable-key'));
        Stripe.createToken({
            number: $('#number').val(),
            cvc: $('#cvc').val(),
            exp_month: $('#month').val(),
            exp_year: $('#year').val()
        }, stripeResponseHandler);
    });

})
