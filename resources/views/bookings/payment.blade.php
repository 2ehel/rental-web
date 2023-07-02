<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Make Booking') }}
        </h2>
    </x-slot>
    <div class="container p-10">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="card">
                    <div class="card-body">
                        <x-slot name="title">
                            <h3 class="panel-title">Payment Details</h3>
                        </x-slot>
    
                        @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                        @endif
    
                        <div>
                            <form class="form-horizontal" method="POST" action="{{ route('bookings.store.payment') }}">
                                @csrf
    
                                <!-- Booking ID -->
                                <x-input id="booking_id" name="booking_id" type="hidden" :value="$bookings['booking_no']" />
    
                                <div class="card-action">
                                    <div class="col-span-6 sm:col-span-4">
                                        <!-- Name on Card -->
                                        <x-label for="name" value="{{ __('Name on Card') }}" />
                                        <input id="name" name="name" type="text" class="mt-1 block w-full" autocomplete="name" />
                                        <x-input-error for="name" class="mt-2" />
                                    </div>
    
                                    <div class="col-span-6 sm:col-span-4">
                                        <!-- Card Number -->
                                        <x-label for="card_number" value="{{ __('Card Number') }}" />
                                        <input id="card_number" name="card_number" class="mt-1 block w-full" autocomplete="card_number" />
                                        <x-input-error for="card_number" class="mt-2" />
                                    </div>
                                </div>
    
                                <div class="card-action">
                                    <div class="col-span-6 sm:col-span-4">
                                        <!-- CVC Card -->
                                        <x-label for="cvc_card" value="{{ __('CVC Card') }}" />
                                        <input id="cvc_card" name="cvc_card" type="text" class="mt-1 block w-full" autocomplete="cvc_card" />
                                        <x-input-error for="cvc_card" class="mt-2" />
                                    </div>
    
                                    <div class="col-span-6 sm:col-span-4">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <!-- Expiration Month -->
                                                <x-label for="expiration_month" value="{{ __('Expiration Month') }}" />
                                                <input id="expiration_month" name="expiration_month" type="text" class="mt-1 block w-full" autocomplete="expiration_month" />
                                                <x-input-error for="expiration_month" class="mt-2" />
                                            </div>
                                            <div class="col-md-6">
                                                <!-- Expiration Year -->
                                                <x-label for="expiration_year" value="{{ __('Expiration Year') }}" />
                                                <input id="expiration_year" name="expiration_year" type="text" class="mt-1 block w-full" autocomplete="expiration_year" />
                                                <x-input-error for="expiration_year" class="mt-2" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="row">
                                    <div class="col-xs-12">
                                        <!-- Submit Button -->
                                        <button class="btn btn-error btn-sm" type="submit" id="total_pay" value="{{ $bookings['total_pay'] }}">
                                            Pay Now {{ 'RM ' . $bookings['total_pay'] }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
