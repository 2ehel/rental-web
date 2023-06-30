<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Make Booking') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default credit-card-box">
                    <div class="panel-heading display-table">
                        <h3 class="panel-title">Payment Details</h3>
                    </div>
                    <div class="panel-body">

                        @if (Session::has('success'))
                            <div class="alert alert-success text-center">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <p>{{ Session::get('success') }}</p>
                            </div>
                        @endif

                        <form role="form" action="{{ route('bookings.session') }}" method="post"
                            class="require-validation" data-cc-on-file="false"
                            data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                            @csrf

                            <div class='card'>
                                <div class='col-span-6 sm:col-span-4'>
                                    <x-label for="name" value="{{ __('Name on Card') }}" />
                                    <x-input id="name" type="text" class="mt-1 block w-full"
                                        autocomplete="name" />
                                    <x-input-error for="name" class="mt-2" />
                                </div>
                            </div>

                            <div class='card'>
                                <div class='col-span-6 sm:col-span-4 form-group card required'>
                                    <x-label for="card_number" value="{{ __('Card Number') }}" />
                                    <x-input id="card_number" type="text" class="mt-1 block w-full"
                                        autocomplete="card_number" />
                                    <x-input-error for="card_number" class="mt-2" />
                                </div>
                            </div>

                            <div class='card'>
                                <div class='col-span-6 sm:col-span-4 col-md-4 form-group cvc required'>
                                    <x-label for="cvc_card" value="{{ __('CVC Card') }}" />
                                    <x-input id="cvc_card" type="text" class="mt-1 block w-full"
                                        autocomplete="cvc_card" />
                                    <x-input-error for="cvc_card" class="mt-2" />
                                </div>

                                <div class='col-span-6 sm:col-span-4 col-md-4 form-group expiration required'>
                                    <x-label for="expiration_month" value="{{ __('Expiration Month') }}" />
                                    <x-input id="expiration_month" type="text" class="mt-1 block w-full"
                                        autocomplete="expiration_month" />
                                    <x-input-error for="expiration_month" class="mt-2" />
                                </div>
                                <div class='col-span-6 sm:col-span-4 col-md-4 form-group expiration required'>
                                    <x-label for="expiration_year" value="{{ __('Expiration Year') }}" />
                                    <x-input id="expiration_year" type="text" class="mt-1 block w-full"
                                        autocomplete="expiration_year" />
                                    <x-input-error for="expiration_year" class="mt-2" />
                                </div>
                            </div>

                            <div class='form-row row'>
                                <div class='col-md-12 error form-group hide'>
                                    <div class='alert-danger alert'>Please correct the errors and try
                                        again.</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now
                                        {{ 'RM ' . $bookings['total_pay'] }}</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript">
        $(function() {

            /*------------------------------------------
            --------------------------------------------
            Stripe Payment Code
            --------------------------------------------
            --------------------------------------------*/

            var $form = $(".require-validation");

            $('form.require-validation').bind('submit', function(e) {
                var $form = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'
                    ].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid = true;
                $errorMessage.addClass('hide');

                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }

            });

            /*------------------------------------------
            --------------------------------------------
            Stripe Response Handler
            --------------------------------------------
            --------------------------------------------*/
            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    /* token contains id, last4, and card type */
                    var token = response['id'];

                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }

        });
    </script>
</x-app-layout>
