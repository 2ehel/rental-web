<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

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
                                            <td class="text-sm">
                                                {{ $bs->car_book->brand . ' ' . $bs->car_book->model ?? $bs->car_id }}
                                                <br> {{ '(' . $bs->car_book->car_plate . ')' }}</td>
                                            <td class="text-sm">{{ $bs->start_date->format(' H:i d/m/Y') ?? null }}</td>
                                            <td class="text-sm"> {{ $bs->duration }} </td>

                                            @if ($bs->booking_status == 'Pending')
                                                <td class="text-sm ">
                                                    <span class="badge badge-secondary"> {{ $bs->booking_status }}
                                                    </span>
                                                </td>
                                            @endif

                                            <td> {{ 'RM ' . $bs->total_pay }} </td>
                                            <td class="py-4 px-6 text-sm text-right whitespace-nowrap">
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('admin.bookings.edit', $bs->id) }}"
                                                        class="btn btn-primary btn-sm">Update Status</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td> No Data bro! </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>


                            <!-- Put this part before </body> tag -->
                            {{-- <div class="modal" id="my-modal-2">
                              <div class="modal-box">
                                <h3 class="font-bold text-lg">Congratulations random Internet user!</h3>
                                <p class="py-4">You've been selected for a chance to get one year of subscription to use Wikipedia for free!</p>
                                <div class="modal-action">
                                    <form method="POST" action="{{ route('bookings.update') }}">


                                 <a href="#" class="btn">Yay!</a>
                                </div>
                              </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
