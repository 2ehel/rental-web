<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(Auth::user()->category == 'Admin')
            <div class="flex justify-end m-2 p-2">
                <a href="{{ route('admin.bookings.create') }}"
                    class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">New Booking</a>
            </div>
            @endif
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow-md sm:rounded-lg">
                            <table class="table w-full">
                                <thead class="bg-gray-50 text-center dark:bg-gray-700">
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Customer ID</th>
                                        <th>Car Book</th>
                                        <th>Start Time</th>
                                        <th>Duration</th>
                                        <th>Booking Status </th>
                                        <th class="text-xs">Total Pay</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    {{-- {{dd($bookings)}} --}}
                                    @forelse ($bookings as $bs)
                                    <tr>
                                        <td class="font-bold">
                                            <div class="text-sm"> {{ $bs->customer_name }}</div>
                                        </td>
                                        <td class="text-sm">{{ $bs->customer_id }}</td>
                                        <td class="text-sm">
                                            @if($bs->car_book)
                                            {{ $bs->car_book->brand." ".$bs->car_book->model}} <br>
                                            {{"(".$bs->car_book->car_plate.")"}}
                                            @endif
                                        </td>
                                        <td class="text-sm">{{ $bs->start_date->format('d.m.Y H:i') ?? null }}</td>
                                        <td class="text-sm"> {{$bs->duration." ".$bs->duration_option}} </td>
                                        <td class="text-sm ">
                                            @if ($bs->booking_status == 'Pending')
                                            <span class="badge badge-secondary"> {{$bs->booking_status}} </span>
                                            @elseif ($bs->booking_status == 'Negotation')
                                            <span class="badge "> {{$bs->booking_status}} </span>
                                            @elseif ($bs->booking_status == 'Cancel')
                                            <span class="badge error"> {{$bs->booking_status}} </span>
                                            @elseif ($bs->booking_status == 'Success')
                                            <span class="badge badge-success"> {{$bs->booking_status}} </span>
                                            @else 
                                            <span class="badge badge-warning"> {{$bs->booking_status}} </span>
                                            @endif
                                        </td>
                                        <td> {{ 'RM '.$bs->total_pay}} </td>
                                        <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('admin.bookings.edit', $bs->id) }}"
                                                    class="btn btn-secondary btn-sm">Edit</a>
                                                <form class="text btn btn-warning btn-sm text-sm text-white"
                                                    method="POST"
                                                    action="{{ route('admin.bookings.destroy', $bs->id) }}"
                                                    onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit">DELETE</button>
                                                </form>
                                                {{-- <div> @if ($bs->booking_status == "Success")
                                                    
                                                @endif
                                                    <a href="{{ route('admin.bookings.updateStatus', $bs->id) }}"
                                                        class="btn btn-secondary btn-sm">Test</a>
                                                </div> --}}
                                            </div>
                                        </td>
                                        {{-- <td>
                                            <div>
                                                <div >
                                                    <form method="POST" action="{{ route('bookings.updateStatus', $bs->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mt-1">
                                                            <select id="booking_status" name="booking_status"
                                                                class="select select-sm select-bordered">
                                                                <option value="Booking Receive"> Booking Receive </option>
                                                                <option value="Pickup Car"> Pickup Car</option>
                                                                <option value="Cancel"> Cancel</option>
                                                                <option value="Payment Success">Payment Success</option>
                                                                <option value="Payment Success">Payment Success</option>
                                                                <option value="Success"> Success </option>
                                                            </select>
                                                        </div> 
                                                        @error('booking_status')
                                                        <div class="text-sm text-red-400">{{ $message }}</div>
                                                        @enderror
                                                            <button type="submit"
                                                                class="btn btn-xs bg-indigo-700 btn-primary">Update</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td> --}}

                                    </tr>
                                    @empty
                                    <tr>
                                        <td> Sorry There Are No Data For Now  </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>