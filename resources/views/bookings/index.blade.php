<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    {{-- {{dd($bookings)}} --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end m-2 p-2">
                <a href="{{ route('bookings.step.one') }}"
                    class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">New Booking</a>
            </div>
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow-md sm:rounded-lg">
                            <table class="table w-full">
                                <thead class="bg-gray-50 text-center text-base-100 dark:bg-gray-700">
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Customer ID</th>
                                        <th>Car Book</th>
                                        <th>Start Time</th>
                                        <th>Duration</th>
                                        <th>Booking Status </th>
                                        <th class="text-xs">Total Pay</th>
                                        <th>Location </th>
                                        <th></th>
                                        {{-- <th></th> --}}
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @forelse ($bookings as $bs)
                                    <tr>
                                        <td class="font-bold">
                                            <div class="text-sm"> {{ $bs->customer_name }}</div>
                                        </td>
                                        <td class="text-sm">{{ $bs->customer_id }}</td>
                                        <td class="text-sm">{{ $bs->car_book->brand." ".$bs->car_book->model ??
                                            $bs->car_id }} <br> {{"(".$bs->car_book->car_plate.")"}}</td>
                                        <td class="text-sm">{{ $bs->start_date->format(' H:i d/m/Y') ?? null }}</td>
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
                                        @if ($bs->car_book && $bs->car_book->location)
                                        <td class="text-sm"><a class="btn btn-xs btn-accent" href="https://www.google.com/maps/search/?api=1&query={!! urlencode($bs->car_book->location) !!}" target="_blank">View Location</a></td>
                                        @else
                                        <td> <p>No Location Stated</p> </td>
                                        @endif
                                    </tr>
                                    @empty
                                    <tr>
                                        <td> Sorry There Are No Data For Now </td>
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
    </div>
</x-app-layout>