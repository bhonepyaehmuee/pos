@extends('.admin.layouts.master')

@section('title')
    Products List
@endsection

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <span class="text-center title-2 row me-1">
                                    <a href="{{ route('admin#orderList') }}" class="text-dark ms-3 fs-4  col-1 ">
                                        <i class="fa-solid fa-arrow-left"></i>
                                    </a>
                                </span>
                                <h3 class="d-block">Back</h3>

                            </div>

                        </div>

                    </div>

                    {{-- @if (count($pizzas) != 0) --}}
                    <div class="table-responsive table-responsive-data2">


                        <div class="row col-6 ">
                            <div class="card mt-4 ">
                                <div class="card-body " style="border-bottom:2px solid black">
                                    <h3 text-center><i class="fa-solid fa-receipt me-2"></i>Order Info</h3>
                                </div>
                                <div class="card-body  ">
                                    <div class="row  p-2 mb-2">
                                        <div class="col "> <i class="fa-solid fa-universal-access me-2"></i> Customer
                                            Name
                                        </div>
                                        <div class="col fw-bolder"> {{ strtoupper($orderList[0]->user_name) }}</div>
                                    </div>
                                    <div class="row p-2 mb-2">
                                        <div class="col"> <i class="fa-solid fa-qrcode me-2"></i> Order Code</div>
                                        <div class="col fw-bolder"> {{ $orderList[0]->order_code }}</div>
                                    </div>
                                    <div class="row p-2 mb-2">
                                        <div class="col"> <i class="fa-solid fa-calendar-days me-2"></i>Order Date</div>
                                        <div class="col fw-bolder"> {{ $orderList[0]->created_at->format('F-j-Y') }}</div>
                                    </div>
                                    <div class="row p-2 mb-2">
                                        <div class="col"> <i class="fa-solid fa-money-bill-1 me-2"></i>Total

                                            <span class="text-warning">(+ delivery fee)</span>

                                        </div>
                                        {{-- variable name is not same with codelab  --}}
                                        <div class="col fw-bolder"> {{ $price->total_price }} kyats</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Order ID</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Item Price</th>
                                    <th>Total(+delivery )</th>
                                    <th>Order Date</th>

                                    {{-- <th></th> --}}
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($orderList as $o)
                                    <tr class=" ">
                                        <td></td>
                                        <td class="">
                                            {{ $o->id }}
                                        </td>
                                        <td class="col-2">
                                            <img src="{{ asset('storage/' . $o->product_image) }}" alt=""
                                                class="img-thumbnail shadow-sm">
                                        </td>
                                        <td>
                                            {{ $o->product_name }}
                                        </td>
                                        <td>
                                            {{ $o->qty }}
                                        </td>
                                        <td class="">
                                            {{ $o->total }}
                                        </td>
                                        <td>
                                            {{ $price->total_price }} kyats
                                        </td>
                                        <td class="">
                                            {{ $o->created_at->format('F-j-Y') }}
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{-- {{ $pizzas->appends(request()->query())->links() }} --}}
                        </div>
                    </div>
                    {{-- @else
                        <h3 class="text-danger text-center mt-3">There is no data you entered!!</h3>
                    @endif --}}
                    <!-- END DATA TABLE -->

                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
    </div>
@endsection
