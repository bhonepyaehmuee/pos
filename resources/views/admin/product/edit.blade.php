@extends('.admin/layouts/master')

@section('title')
    Product List
@endsection

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                {{-- <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{ route('admin#changePasswordPage') }}"><button
                                class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div> --}}

                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">

                            <div class="card-title ">
                                <div class="ms-5 fs-4 ">

                                </div>

                                <h2 class="text-center title-2 row">
                                    <a href="{{ route('product#list') }}" class="text-dark ms-3 fs-4  col-1 ">
                                        <i class="fa-solid fa-arrow-left"></i>
                                    </a><span class="col-5 offset-3">Pizza Information</span>
                                </h2>

                            </div>
                            @if (session('notMatch'))
                                <div class="col-12">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="fa-solid fa-triangle-exclamation"></i> {{ session('notMatch') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif
                            @if (session('changeSuccess'))
                                <div class="col-12 ">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="fa-solid fa-check"></i> {{ session('changeSuccess') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif

                            @if (session('updateSuccess'))
                                <div class="col-6 offset-5 ">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="fa-solid fa-check"></i> {{ session('updateSuccess') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif
                            <hr>

                            <div class="row">
                                <div class="col-3 offset-1 ">

                                    <img src="{{ asset('storage/' . $pizza->image) }}" class="img-thumbnail shadow-sm" />


                                </div>
                                <div class="col-5 offset-1  ">

                                    <div class="form-group">
                                        <div class="mt-2">
                                            <strong class="control-label mb-1 my-2 ">
                                            </strong>
                                            <h5 class="fs-4"><span>{{ $pizza->name }}</span></h5>
                                        </div>
                                        <div class="mt-2">
                                            <strong class="control-label mb-1  my-2 ">Price -
                                            </strong><span>{{ $pizza->price }} kyats</span>
                                        </div>
                                        <div class="mt-2">
                                            <strong class="control-label mb-1  my-2 ">waiting Time -
                                            </strong><span>{{ $pizza->waiting_time }} minutes</span>
                                        </div>
                                        <div class="mt-2">
                                            <strong class="control-label mb-1  my-2 ">View Count -
                                            </strong><span>{{ $pizza->view_count }} </span>
                                        </div>
                                        <div class="mt-2">
                                            <strong class="control-label mb-1  my-2 ">Category Name -
                                            </strong><span>{{ $pizza->category_name }} </span>
                                        </div>

                                        <div class="mt-2">
                                            <strong class="control-label mb-1  my-2 ">created time -
                                            </strong><span>{{ $pizza->created_at->format('j-F-y') }} </span>
                                        </div>
                                        <div class="mt-2">
                                            <strong class="control-label mb-1 my-2 ">Description -
                                            </strong><span class="d-block text-justify">{{ $pizza->description }}</span>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 offset-6 mt-2">
                                    <a href="{{ route('product#updatePage', $pizza->id) }}">
                                        <button class="btn bg-dark text-white">
                                            <i class="fa-solid fa-user-pen"></i>Edit here
                                        </button>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
    </div>
@endsection
