@extends('user.layouts.master')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table id="dataTable" class="table table-light table-borderless table-hover text-center mb-0">
                    <div class="col-1 mb-4 px-2"> <a href="{{ route('user#home') }}" class="text-dark  ">
                            <i class="fa-solid fa-arrow-left  fs-3"></i>
                        </a>
                    </div>
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">

                        @foreach ($cartList as $c)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $c->image) }}" class="img-thumbnail"
                                        style="width: 100px;">
                                </td>
                                <td class="align-middle">
                                    {{ $c->pizza_name }}

                                    <input type="hidden" class="orderId" value="{{ $c->id }}">

                                    <input type="hidden" class="userId" value="{{ $c->user_id }}">
                                    <input type="hidden" class="productId" value="{{ $c->product_id }}">

                                </td>
                                <td class="align-middle" id="price">{{ $c->pizza_price }} kyats</td>
                                <td class="align-middle">

                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text"
                                            class="form-control form-control-sm bg-secondary border-0 text-center"
                                            value="{{ $c->qty }}" id="qty">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle" id="total">{{ $c->pizza_price * $c->qty }} kyats</td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i
                                            class="fa fa-times"></i></button></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotalPrice">{{ $totalPrice }} kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium">2000 kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalPrice">{{ $totalPrice + 2000 }} kyats</h5>
                        </div>
                        <button id="orderBtn" class="btn btn-block btn-primary font-weight-bold my-3 py-3">
                            Proceed To Checkout</button>
                        <button id="clearBtn" class="btn btn-block btn-info font-weight-bold my-3 py-3">
                            Clear Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {

            // for plus button
            // class selector so use with (.)
            $('.btn-plus').click(function() {
                $parentNode = $(this).parents("tr");
                $price = Number($parentNode.find('#price').html().replace(' kyats', ''));
                // console.log(jQuery.type($price));
                $qty = Number($parentNode.find('#qty').val());
                // console.log(typeof $qty);
                $total = $price * $qty;
                $parentNode.find('#total').html($total + " kyats");

                summaryCalculation();
            });


            // for minus button
            $('.btn-minus').click(function() {
                $parentNode = $(this).parents("tr");
                $price = Number($parentNode.find('#price').html().replace(' kyats', ''));
                $qty = Number($parentNode.find('#qty').val());
                // console.log($price + "    " + $qty);
                $total = $price * $qty;
                $parentNode.find('#total').html($total + " kyats");

                summaryCalculation();
            });

            // for remove button to remove cart data in the database
            $('.btnRemove').click(function() {
                $parentNode = $(this).parents("tr");
                $productId = $parentNode.find(".productId").val();
                $orderId = $parentNode.find(".orderId").val();

                $.ajax({
                    type: 'get',
                    url: '/user/ajax/clear/current/product',
                    data: {
                        'productId': $productId,
                        'orderId': $orderId,
                    },
                    dataType: 'json',
                })

                $parentNode.remove();

                summaryCalculation();
            })



            // for summary (subtotal)
            function summaryCalculation() {
                $totalPrice = 0;
                $('#dataTable tbody tr').each(function(index, row) {
                    $totalPrice += Number($(row).find('#total').text().replace("kyats", ""));
                })
                $('#subTotalPrice').html(`${$totalPrice} kyats`);
                $('#finalPrice').html(`${$totalPrice +2000} kyats`);
            }
        })
    </script>

    {{-- ajax --}}
    <script>
        $('#orderBtn').click(function() {
            $orderList = [];
            $random = Math.floor(Math.random() * 1000000001);

            $('#dataTable tbody tr').each(function(index, row) {
                $orderList.push({
                    'user_id': $(row).find('.userId').val(),
                    'product_id': $(row).find('.productId').val(),
                    'qty': $(row).find('#qty').val(),
                    'total': $(row).find('#total').text().replace('kyats', '') * 1,
                    'order_code': 'POS' + $random
                });

            });
            // console.log($orderList);
            $.ajax({
                type: 'get',
                url: '/user/ajax/order',
                // type cast to object from array format
                data: Object.assign({}, $orderList),
                dataType: 'json',
                success: function(response) {
                    if (response.status == "true") {
                        window.location.href = "/user/homePage";
                    }
                }
            });

        });

        // when clear btn click, to remove the cart list u orded
        $('#clearBtn').click(function() {
            $('#dataTable tbody tr').remove();
            $('#subTotalPrice').html('0 kyats');
            $('#finalPrice').html('2000 kyats');

            $.ajax({
                type: 'get',
                dataType: 'json',
                url: "/user/ajax/clear/cart",

            })
        });
    </script>
@endsection
