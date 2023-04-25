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
                                <a href="{{ route('admin#details') }}" class="text-dark ms-3 fs-4  col-1 ">
                                    <i class="fa-solid fa-arrow-left"></i>
                                </a><span class="col-4 offset-3">Update Information</span>
                            </h2>
                            <hr>
                            <form action="{{ route('admin#update', Auth::user()->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1 ">
                                        @if (Auth::user()->image == null)
                                            @if ($a->gender == 'female')
                                                <img src="{{ asset('image/default_user_female.jpg') }}"
                                                    class="img-thumbnail shadow-sm" alt="">
                                            @else
                                                <img src="{{ asset('image/default_user.png') }}"
                                                    class="img-thumbnail shadow-sm" alt="">
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="">
                                        @endif
                                        {{-- <div class="form-group">
                                            <div class="control-label mb-1 my-2  ">Role - {{ Auth::user()->role }}
                                                <span style="font-size:12px" class="text-danger">(You cannot change the
                                                    role!!)
                                                </span>
                                            </div>
                                        </div> --}}
                                        <div class="mt-3">
                                            <input type="file" name="image" id=""
                                                class="form-control @error('image') is-invalid @enderror">
                                            @error('image')
                                                <div class="invalid-feedback"> {{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mt-3 col-7 offset-5 ">
                                            <button class="btn bg-dark text-white form-control" type="submit">
                                                <i class="fa-regular fa-floppy-disk me-2"></i>Update</button>
                                        </div>
                                    </div>


                                    <div class="col-6">
                                        <form action="" method="get">
                                            <div class="form-group">
                                                <label class="control-label mb-1 my-2 ">Name -</label>
                                                <input id="cc-pament" name="name" type="text"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    value="{{ old('name', Auth::user()->name) }}" aria-required="true"
                                                    aria-invalid="false" placeholder="Enter Admin Name...">
                                                @error('name')
                                                    <div class="invalid-feedback"> {{ $message }}</div>
                                                @enderror
                                            </div>


                                            <div class="form-group">
                                                <label class="control-label mb-1 my-2 ">Email -</label>
                                                <input id="cc-pament" name="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    value="{{ old('name', Auth::user()->email) }}" aria-required="true"
                                                    aria-invalid="false" placeholder="Enter Admin Email ...">
                                                @error('email')
                                                    <div class="invalid-feedback"> {{ $message }}</div>
                                                @enderror
                                            </div>


                                            <div class="form-group">
                                                <label class="control-label mb-1 my-2 ">Phone -</label>
                                                <input id="cc-pament" name="phone" type="text"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    value="{{ old('phone', Auth::user()->phone) }}" aria-required="true"
                                                    aria-invalid="false" placeholder="Enter Admin Phone...">
                                                @error('phone')
                                                    <div class="invalid-feedback"> {{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class=" control-label mb-1 my-2 ">Gender -</label>
                                                <select name="gender" id=""
                                                    class="form-control @error('gender') is-invalid @enderror">
                                                    <option value="">Choose Your Gender here</option>
                                                    <option value="male"
                                                        @if (Auth::user()->gender == 'male') selected @endif>Male</option>
                                                    <option value="female"
                                                        @if (Auth::user()->gender == 'female') selected @endif>Female
                                                    </option>
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <label class="control-label mb-1 my-2 ">Address -</label>
                                                <textarea name="address" id="" class="form-control @error('address') is-invalid @enderror" cols="30"
                                                    rows="10" placeholder="Enter Admin Address...">{{ old('address', Auth::user()->address) }}</textarea>
                                                @error('address')
                                                    <div class="invalid-feedback"> {{ $message }}</div>
                                                @enderror
                                            </div>


                                            <div class="form-group">
                                                <label class="control-label mb-1 my-2 ">Role -</label>
                                                <input id="cc-pament" name="role" type="text"
                                                    class="form-control @error('role') is-invalid @enderror"
                                                    value={{ old('role', Auth::user()->role) }} aria-required="true"
                                                    aria-invalid="false" placeholder="You can't change your role" disabled>
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
