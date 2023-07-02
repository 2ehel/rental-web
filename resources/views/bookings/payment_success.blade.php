<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Thank You') }}
        </h2>
    </x-slot>
    <div class="hero min-h-screen bg-base-200">
        <div class="hero-content text-center">
          <div class="max-w-md">
            <h1 class="text-5xl font-bold">Hello there</h1>
            <p class="py-6">Your Payment successfull. Now wait for renter to approve the payment</p>
            <h3 class="text-xl font-bold">Thank you for using our service!</h3>
            <div class="pt-5">
            <a href="{{route('bookings.index')}} " class="btn btn-primary">Go to booking section!</a>
            </div>
          </div>
        </div>
      </div>
</x-app-layout>
