<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow-md sm:rounded-lg">
                            @if ($record == "invoice")
                            <table class="table w-full">
                                <thead class="bg-gray-50 text-center text-base-100 dark:bg-gray-700">
                                    <tr>
                                        <th>Invoice Number</th>
                                        <th>Booking ID</th>
                                        
                                        <th>Invoice Details</th>
                                        <th class="text-xs">Total Pay</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @forelse ($listing as $iv)
                                    <tr>
                                        <td class="text-sm">{{ $iv->book_invoice->invoice_no }}</td>
                                            <td class="text-sm">{{ $iv->book_invoice->booking_id }}</td>
                                            
                                            <td class="text-sm">{{ $iv->book_invoice->invoice_details }}</td>
                                        <td class="text-sm"> {{ 'RM '.$iv->total_pay}} </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td> Sorry There Are No Data For Now </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            @elseif ($record == "history")
                            <table class="table w-full">
                                <thead class="bg-gray-50 text-center text-base-100 dark:bg-gray-700">
                                    <tr>
                                        <th>Title</th>
                                        <th>History Number</th>
                                        <th>Status</th>
                                        {{-- <th>Description</th> --}}
                                        <th>Booking Number</th>
                                        <th>Invoice Number</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @forelse ($listing as $bh)
                                    <tr>
                                        <td class="text-sm">{{ $bh->book_history->title }}</td>
                                            <td class="text-sm">{{ $bh->book_history->history_no }}</td>
                                            <td class="text-sm">{{ $bh->book_history->status }}</td>
                                            {{-- <td class="text-sm">{{ $bh->book_history->description }}</td> --}}
                                            <td class="text-sm">{{ $bh->book_history->booking_no }}</td>
                                            <td class="text-sm">{{ $bh->book_history->invoice_no }}</td>
                                            
                                    </tr>
                                    @empty
                                    <tr>
                                        <td> Sorry There Are No Data For Now </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            @endif
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
