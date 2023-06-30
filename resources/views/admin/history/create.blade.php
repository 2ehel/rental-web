<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    {{-- {{dd(Auth::user()->name)}} --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex m-2 p-2">
                <a href="{{ route('admin.bookings.index') }}"
                    class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 btn btn-sm rounded-lg text-white">Bookings
                    Index</a>
            </div>
            <div class="m-2 p-2 bg-slate-100 rounded">
                <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                    <form method="POST" action="{{ route('admin.bookings.store') }}">
                        @csrf
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
                            <div class="mt-1">
                                <input type="hidden" id="customer_name" name="customer_name"
                                    value="{{Auth::user()->name}}"
                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('customer_name')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="sm:col-span-6">
                            <label for="start_date" class="block text-sm font-medium text-gray-700"> Start Date
                            </label>
                            <div class="mt-1">
                                <input type="datetime-local" id="start_date" name="start_date"
                                    class="block w-full appearance-none bg-white input input-bordered input-sm w-full max-w-xs border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('start_date')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-6">
                            <label for="end_date" class="block text-sm font-medium text-gray-700"> End Date
                            </label>
                            <div class="mt-1">
                                <input type="datetime-local" id="end_date" name="end_date"
                                    class="block w-full appearance-none bg-white input input-bordered input-sm w-full max-w-xs border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('end_date')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="sm:col-span-6 pt-5">
                            <label for="status" class="block text-sm font-medium text-gray-700">Car Selected</label>
                            <div class="mt-1">
                                <select id="car_id" name="car_id"
                                    class="form-multiselect block w-full mt-1 select select-bordered select-sm w-full max-w-xs">
                                    <option> Select Car
                                    </option>
                                    @foreach ($cars as $car)
                                    <option value="{{ $car->id }}">{{ $car->brand }}{{" ". $car->model }} (
                                        {{$car->car_plate}})
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('car_id')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-6 p-4">
                            <button type="submit"
                                class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg btn btn-sm text-white">Book</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-admin-layout>