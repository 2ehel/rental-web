<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Make Booking') }}
        </h2>
    </x-slot>
    <div class="container w-full px-5 py-6 mx-auto">
        <div class="flex items-center min-h-screen bg-gray-50">
            <div class="flex-1 h-full max-w-4xl mx-auto bg-neutral-content rounded-lg shadow-xl">
                <div class="flex flex-col md:flex-row">
                    <div class="h-32 md:h-auto md:w-1/2">
                        <img class="object-cover h-full" src=" {{ URL::asset('img\fendi.jpg') }}" alt="img" />
                    </div>
                    <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                        <div class="w-full">
                            <h3 class="mb-4 text-xl font-bold text-blue-600">Make Booking</h3>

                            <div class="w-full bg-gray-200 rounded-full">
                                <div
                                    class="w-40 p-1 text-xs font-medium leading-none text-center text-blue-100 bg-blue-600 rounded-full">
                                    Step 1</div>
                            </div>

                            <form method="POST" action="{{ route('bookings.store.step.one') }}">
                                @csrf
                                <div class="sm:col-span-6">
                                    <div class="mt-1">
                                        <input type="hidden" id="customer_id" name="customer_id"
                                            value="{{Auth::user()->id}}"
                                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                    </div>
                                    @error('customer_id')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="sm:col-span-6">
                                    <div class="mt-1">
                                        <input type="hidden" id="booking_status" name="booking_status" value="Pending"
                                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                    </div>
                                    @error('booking_status')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="sm:col-span-6">
                                    <div class="mt-1">
                                        <input type="hidden" id="total_pay" name="total_pay" value="10"
                                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                    </div>
                                    @error('total_pay')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="sm:col-span-6">
                                    <label for="first_name" class="block text-sm font-medium text-gray-700"> First Name
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" id="first_name" name="first_name"
                                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                    </div>
                                    @error('first_name')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="sm:col-span-6">
                                    <label for="last_name" class="block text-sm font-medium text-gray-700"> Last Name
                                    </label>
                                    <div class="mt-1">
                                        <input type="text" id="last_name" name="last_name"
                                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                    </div>
                                    @error('last_name')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="sm:col-span-6 py-4">
                                    <label for="start_date" class="block text-sm font-medium text-gray-700"> Booking
                                        Date
                                    </label>
                                    <div class="mt-1">
                                        <input type="datetime-local" id="start_date" name="start_date"
                                            class="block w-full appearance-none bg-white input input-bordered input-sm w-full max-w-xs border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                    </div>
                                    @error('start_date')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                    @enderror
                                </div>
                                @php
                                $hour_duration = range(1,24);
                                // dd($hour_duration);
                                @endphp
                                <div class="sm:col-span-6">
                                    <label for="duration" class="block text-sm font-medium text-gray-700"> Rent Duration
                                    </label>
                                    <div class="sm:col-span-3">
                                        <div class="form-control">
                                            <label class="label cursor-pointer">
                                                <span class="label-text">Hours</span>
                                                <input type="radio" id="duration_option" name="duration_option"
                                                    value="hours" class="radio checked:bg-red-500" checked />
                                            </label>
                                        </div>
                                        <div class="form-control">
                                            <label class="label cursor-pointer">
                                                <span class="label-text">Days</span>
                                                <input type="radio" id="duration_option" name="duration_option"
                                                    value="days" class="radio checked:bg-blue-500" checked />
                                            </label>
                                        </div>
                                    </div>
                                    <select id="duration" name="duration"
                                        class="form-multiselect block w-full mt-1 select select-bordered select-sm w-full max-w-xs">
                                        <option value=""> Select Duration </option>
                                        @foreach ($hour_duration as $hour)
                                        <option value="{{ $hour }}">{{ $hour }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('duration')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror

                                <div class="mt-6 p-4 flex justify-end">
                                    <button type="submit"
                                        class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Next</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script language="JavaScript" type="text/JavaScript">
        <!--
        function combine(form) {
        form.customer_name.value = form.first_name.value + form.last_name.value;
        }
        //-->
    </script>
</x-app-layout>