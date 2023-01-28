<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex m-2 p-2">
                <a href="{{ route('admin.tables.index') }}"
                    class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Table Index</a>
            </div>
            {{-- {{dd($booking)}} --}}
            <div class="m-2 p-2 bg-slate-100 rounded">
                <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                    <form method="POST" action="{{ route('admin.bookings.update', $booking->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="sm:col-span-6">
                            <div class="mt-1">
                                <input type="hidden" id="cust_id" name="cust_id" value="{{Auth::user()->id}}"
                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('cust_id')
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
                            <label for="customer_name" class="block text-sm font-medium text-gray-700"> Customer Name
                            </label>
                            <div class="mt-1">
                                <input type="text" id="customer_name" readonly name="customer_name"
                                    value="{{$booking->customer_name}}"
                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('customer_name')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="sm:col-span-6 py-4">
                            <label for="start_date" class="block text-sm font-medium text-gray-700"> Start Date
                            </label>
                            <div class="mt-1">
                                <input type="datetime-local" id="start_date" name="start_date"
                                    value="{{$booking->start_date}}"
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
                                        <input type="radio" id="duration_option" name="duration_option" value="hours"
                                            class="radio checked:bg-red-500" checked />
                                    </label>
                                </div>
                                <div class="form-control">
                                    <label class="label cursor-pointer">
                                        <span class="label-text">Days</span>
                                        <input type="radio" id="duration_option" name="duration_option" value="days"
                                            class="radio checked:bg-blue-500" checked />
                                    </label>
                                </div>
                            </div>
                            <select id="duration" name="duration"
                                class="form-multiselect block w-full mt-1 select select-bordered select-sm w-full max-w-xs">
                                <option value="{{$booking->duration}} "> {{$booking->duration}} </option>
                                @foreach ($hour_duration as $hour)
                                <option value="{{ $hour }}">{{ $hour }} </option>
                                @endforeach
                            </select>
                        </div>
                        @error('duration')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror


                        <div class="sm:col-span-6 pt-5">
                            <label for="car_id" class="block text-sm font-medium text-gray-700">Car Selected</label>
                            <div class="mt-1">
                                <input id="car_id" name="car_id" readonly value="{{$booking->car_id}}"
                                    class=" block w-full mt-1 input input-bordered input-sm w-full max-w-xs">
                            </div>
                            @error('car_id')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="sm:col-span-6 pt-5">
                            <label for="booking_status" class="block text-sm font-medium text-gray-700"> Booking Status
                            </label>
                            <div class="mt-1">
                                <select id="booking_status" name="booking_status" 
                                    class="form-multiselect block w-full mt-1 select select-bordered select-sm w-full max-w-xs">
                                    <option value="{{$booking->booking_status}} "> {{$booking->booking_status}} </option>
                                    <option value="Pending"> Pending </option>
                                    <option value="Negotation"> Negotation </option>
                                    <option value="Success"> Success </option>
                                </select>
                            </div>
                            @error('booking_status')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-6 p-4">
                            <button type="submit"
                                class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg btn btn-sm text-white">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</x-admin-layout>