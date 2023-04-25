@extends('user.layouts.master')

@section('content')
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3">
                    <span class="bg-secondary pr-3">Filter
                        by price</span>
                </h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="bg-dark d-flex align-items-center justify-content-center   shadow-sm">

                            <div class=" text-white  shadow-sm" for="price-all">Categories
                                <span class="badge text-bg-secondary ">{{ count($category) }}</span>
                            </div>
                            <span class="badge border font-weight-normal"></span>

                        </div>
                        <hr>
                        <div class=" d-flex align-items-center justify-content-between mb-3">
                            <label class="label" for="name">
                                <a href="{{ route('user#home') }}" class="text-dark">

                                    All</label></a>
                        </div>
                        @foreach ($category as $c)
                            <div class=" d-flex align-items-center justify-content-between mb-3">
                                <label class="label" for="name">

                                    <a href="{{ route('user#filter', $c->id) }}" class="text-dark">

                                        {{ $c->name }}</label></a>
                            </div>
                        @endforeach
                    </form>
                </div>
                <!-- Price End -->




            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <a href="{{ route('user#cartList') }}">
                                    <button type="button" class="btn btn-primary position-relative">
                                        <i class="fa-solid fa-cart-plus"></i>
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ count($cart) }}

                                        </span>
                                    </button>
                                </a>
                                <a href="{{ route('user#history') }}" class="ms-3">
                                    <button type="button" class="btn btn-primary position-relative">
                                        <i class="fa-solid fa-clock-rotate-left mx-2"></i>History
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ count($history) }}

                                        </span>
                                    </button>
                                </a>

                                <a href="{{ route('user#contactUsForm') }}" class="ms-3">
                                    <button type="button" class="btn btn-primary position-relative">
                                        <i class="fa-regular fa-id-card me-2"></i>Contact me

                                    </button>
                                </a>

                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    <select name="sorting" id="sortingOption" class="form-control ">
                                        <option value="" class="">Sort by ▼

                                        </option>
                                        <option value="asc">Ascending ▼</option>
                                        <option value="desc">Descending ▼</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row" id="dataList">
                        @if (count($pizza) != 0)
                            @foreach ($pizza as $p)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4" id="myForm">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" style="height:200px; width:100%"
                                                src="{{ asset('storage/' . $p->image) }}" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i
                                                        class="fa fa-shopping-cart"></i></a>

                                                <a class="btn btn-outline-dark btn-square"
                                                    href="{{ route('user#pizzaDetails', $p->id) }}"><i
                                                        class="fa-solid fa-info"></i></a>

                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate"
                                                href="">{{ $p->name }}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>{{ $p->price }} kyats</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center bg-secondary text-white fs-2 col-6 offset-3 py-5">
                                <i class="fa-solid fa-face-frown"></i>There is no pizza
                            </p>
                        @endif
                    </div>



                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection
@section('scriptSource')
    <script>
        $(document).ready(function() {

            $('#sortingOption').change(function() {
                $sorting = $('#sortingOption').val();
                // console.log($sorting);
                if ($sorting == 'asc') {
                    // console.log('Ascending');
                    $.ajax({
                        type: 'get',
                        url: '/user/ajax/pizza/list',
                        data: {
                            'status': 'asc'
                        },
                        dataType: 'json',
                        success: function(resp) {

                            $list = '';
                            for ($i = 0; $i < resp.length; $i++) {
                                // console.log(`${resp[$i].name}`)
                                $list += `  <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4" id="myForm">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" style="height:200px; width:100%"
                                            src="{{ asset('storage/${resp[$i].image}') }}" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i
                                                    class="fa fa-shopping-cart"></i></a>

                                            <a class="btn btn-outline-dark btn-square" href=""><i
                                                    class="fa-solid fa-info"></i></a>

                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate"
                                            href="">${resp[$i].name}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>${resp[$i].price} kyats</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                            }

                            $(
                                '#dataList'
                            ).html($list);
                        }
                    })
                } else if ($sorting == 'desc') {
                    $.ajax({
                        type: 'get',
                        url: '/user/ajax/pizza/list',
                        data: {
                            'status': 'desc'
                        },
                        dataType: 'json',
                        success: function(resp) {

                            $list = '';
                            for ($i = 0; $i < resp.length; $i++) {
                                // console.log(`${resp[$i].name}`)
                                $list += `  <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4" id="myForm">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" style="height:200px; width:100%"
                                            src="{{ asset('storage/${resp[$i].image}') }}" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i
                                                    class="fa fa-shopping-cart"></i></a>

                                            <a class="btn btn-outline-dark btn-square" href=""><i
                                                    class="fa-solid fa-info"></i></a>

                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate"
                                            href="">${resp[$i].name}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>${resp[$i].price} kyats</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                            }

                            $(
                                '#dataList'
                            ).html($list);
                        }
                    })
                }
            });
        });
    </script>
@endsection
