@extends('user.layouts.master')

@section('content')
    <!-- Shop Detail Start -->

    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class=" img-thumbnail" style="width:100%; height: auto"
                                src="{{ asset('storage/' . $details->image) }}" alt="Image">
                        </div>

                    </div>

                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">

                <div class="h-100 bg-light p-30">
                    <div class="row  mb-5">
                        <div class="col-1"> <a href="{{ route('user#home') }}" class="text-dark ">
                                <i class="fa-solid fa-arrow-left  fs-3"></i>
                            </a>
                        </div>
                        <div class="col text-center">
                            <h2 class="fs-1" style="color:cadetblue;font-size:5 rem">Pizza Details</h2>
                        </div>
                    </div>
                    <h4>{{ $details->name }}</h4>
                    <input type="hidden" name="" value="{{ Auth::user()->id }}" id="userId">
                    <input type="hidden" name="" value="{{ $details->id }}" id="pizzaId">
                    <div class="d-flex mb-3">
                        <small class="pt-1 fw-bold"><i class="fa-solid fa-eye me-2"></i> {{ $details->view_count + 1 }}
                        </small>
                    </div>
                    <h4 class="font-weight-semi-bold mb-4">{{ $details->price }} Kyats</h4>
                    <p class="mb-4">{{ $details->description }}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            {{-- order count value  --}}
                            <input type="text" class="form-control bg-secondary border-0 text-center" id="orderCount"
                                value="1">

                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary px-3" id="addCartBtn"><i
                                class="fa fa-shopping-cart mr-1"></i> Add
                            To Cart</button>


                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You
                May Also Like</span></h2>


        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($pizzaList as $pizzalist)
                        <div class="product-item bg-light">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid img-thumbnail" src="{{ asset('storage/' . $pizzalist->image) }}"
                                    alt="" style="width:100%; height:250px">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href="">
                                        <i class="fa fa-shopping-cart"></i></a>

                                    <a class="btn btn-outline-dark btn-square"
                                        href="{{ route('user#pizzaDetails', $pizzalist->id) }}">
                                        <i class="fa-solid fa-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $pizzalist->name }}</a>
                                <div><i class="fa-solid fa-eye"></i> {{ $pizzalist->view_count }} </div>
                                <div class="d-flex align-items-center justify-content-center mt-2">

                                    <h5>{{ $pizzalist->price }} Kyats</h5>

                                </div>

                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Products End -->
@endsection
@section('scriptSource')
    <script>
        $(document).ready(function() {
            // console.log($("#pizzaId").val());

            // view Count
            $.ajax({
                type: 'get',
                dataType: 'json',
                url: '/user/ajax/increase/viewCount',
                data: {
                    'productId': $('#pizzaId').val(),
                },

            })



            // for add to cart button
            $('#addCartBtn').click(function() {

                $source = {
                    'count': $('#orderCount').val(),
                    'userId': $('#userId').val(),
                    'pizzaId': $('#pizzaId').val(),
                };


                $.ajax({
                    type: 'get',
                    dataType: 'json',
                    url: '/user/ajax/addToCart',
                    data: $source,
                    success: function(resp) {
                        if (resp.status == "success") {
                            window.location.href = ("/user/homePage");
                        }
                    }
                })
            });

        })
    </script>
@endsection
