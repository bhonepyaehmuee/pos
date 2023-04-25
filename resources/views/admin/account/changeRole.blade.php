@extends('.admin/layouts/master')

@section('title')
    Category List
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
                                <a href="{{ route('admin#list') }}" class="text-dark ms-3 fs-4  col-1 ">
                                    <i class="fa-solid fa-arrow-left"></i>
                                </a><span class="col-5 offset-3">Change Role</span>
                            </h2>
                            <hr>
                            <form action="{{ route('admin#change', $account->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1 ">
                                        @if ($account->image == null)
                                            @if ($account->gender == 'female')
                                                <img src="{{ asset('image/default_user_female.jpg') }}"
                                                    class="img-thumbnail shadow-sm" alt="">
                                            @else
                                                <img src="{{ asset('image/default_user.png') }}"
                                                    class="img-thumbnail shadow-sm" alt="">
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/' . $account->image) }}" alt="">
                                        @endif

                                        <div class="mt-3 col-7 offset-5 ">
                                            <button class="btn bg-dark text-white form-control" type="submit">
                                                <i class="fa-regular fa-floppy-disk me-2"></i>Update</button>
                                        </div>
                                    </div>


                                    <div class="col-6">
                                        <form action="" method="get">
                                            <div class="form-group">
                                                <div class=" ">

                                                    <div class="form-group">
                                                        <label class="control-label mb-1 my-2 ">Name -
                                                            <strong>{{ $account->name }}</strong>
                                                        </label>
                                                        <label class="control-label mb-1 d-block my-2">Email -
                                                            <strong>{{ $account->email }}</strong>
                                                        </label>
                                                        <label class="control-label mb-1 d-block my-2">Phone -
                                                            <strong>{{ $account->phone }}</strong>
                                                        </label>
                                                        <label class="control-label mb-1 d-block my-2">Gender -
                                                            <strong>{{ $account->gender }}</strong>
                                                        </label>
                                                        <label class="control-label mb-1 d-block my-2">address -
                                                            <strong>{{ $account->address }}</strong>
                                                        </label>
                                                        <label class="control-label mb-1 d-block my-2">Joined Date -
                                                            <strong>{{ $account->created_at->format('j F Y') }}</strong>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1 my-2 ">Role -</label>
                                                    <select name="role" id="" class="form-control">Role-
                                                        <option value="admin"
                                                            @if ($account->role == 'admin') selected @endif>Admin</option>
                                                        <option value="user"
                                                            @if ($account->role == 'user') selected @endif>User</option>
                                                    </select>
                                                    {{-- <input id="cc-pament" name="role" type="text"
                                                        class="form-control @error('role') is-invalid @enderror"
                                                        value={{ old('role', $account->role) }} aria-required="true"
                                                        aria-invalid="false" placeholder="You can't change your role"> --}}
                                                    @error('role')
                                                        <div class="invalid-feedback"> {{ $message }}</div>
                                                    @enderror
                                                </div>

                                        </form>

                                    </div>

                                </div>
                                <div class="row col-6 offset-3 mt-4">

                                </div>
                                <div class="row col-6 offset-3 mt-4">



                                </div>
                            </form>
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
