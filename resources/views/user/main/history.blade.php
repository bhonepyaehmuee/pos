@extends('user.layouts.master')
@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <table id="dataTable" class="table table-light table-borderless table-hover text-center mb-0">
                    <div class="col-1 mb-4 px-2"> <a href="{{ route('user#home') }}" class="text-dark  ">
                            <i class="fa-solid fa-arrow-left  fs-3"></i>
                        </a>
                    </div>
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            {{-- <th>Order ID</th> --}}
                            <th>Order Code</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th></th>


                        </tr>
                    </thead>
                    <tbody class="align-middle">

                        @foreach ($order as $o)
                            <tr>
                                {{-- <td class="align-middle" id="total">{{ $o->id }} </td> --}}
                                <td class="align-middle" id="total">{{ $o->order_code }} </td>
                                <td class="align-middle" id="total">{{ $o->total_price }} </td>
                                <td class="align-middle" id="total">{{ $o->status }} </td>
                                <td class="align-middle" id="total">{{ $o->created_at->format('j-F-y') }} </td>
                                <td>
                                    @if ($o->status == 0)
                                        <span class="text-warning "> <i class="fa-solid fa-spinner me-2"></i>Pending...
                                        </span>
                                    @elseif ($o->status == 1)
                                        <span class="text-success "><i
                                                class="fa-solid fa-circle-check me-2"></i>Success</span>
                                    @elseif ($o->status == 2)
                                        <span class="text-danger "><i
                                                class="fa-solid fa-triangle-exclamation me-2"></i>Reject</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $order->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
