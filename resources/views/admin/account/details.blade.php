@extends('.admin/layouts/master')

@section('title')
    Details
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

                            <h2 class="text-center title-2 row">
                                <a href="{{ route('category#list') }}" class="text-dark ms-3 fs-4  col-1 ">
                                    <i class="fa-solid fa-arrow-left"></i>
                                </a><span class="col-4 offset-3">Account Information</span>
                            </h2>
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
                                    @if (Auth::user()->image == null)
                                        @if ($a->gender == 'female')
                                            <img src="{{ asset('image/default_user_female.jpg') }}"
                                                class="img-thumbnail shadow-sm" alt="">
                                        @else
                                            <img src="{{ asset('image/default_user.png') }}" class="img-thumbnail shadow-sm"
                                                alt="">
                                        @endif
                                    @else
                                        <img src="{{ asset('storage/' . Auth::user()->image) }}" class="img-thumbnail" />
                                    @endif
                                </div>
                                <div class="col-5 offset-2 ">

                                    <div class="form-group">
                                        <label class="control-label mb-1 my-2 ">Name -
                                            <strong>{{ Auth::user()->name }}</strong>
                                        </label>
                                        <label class="control-label mb-1 d-block my-2">Email -
                                            <strong>{{ Auth::user()->email }}</strong>
                                        </label>
                                        <label class="control-label mb-1 d-block my-2">Phone -
                                            <strong>{{ Auth::user()->phone }}</strong>
                                        </label>
                                        <label class="control-label mb-1 d-block my-2">Gender -
                                            <strong>{{ Auth::user()->gender }}</strong>
                                        </label>
                                        <label class="control-label mb-1 d-block my-2">address -
                                            <strong>{{ Auth::user()->address }}</strong>
                                        </label>
                                        <label class="control-label mb-1 d-block my-2">Joined Date -
                                            <strong>{{ Auth::user()->created_at->format('j F Y') }}</strong>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 offset-6 mt-2">
                                    <a href="{{ route('admin#edit') }}">
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
