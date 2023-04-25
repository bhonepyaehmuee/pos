@extends('.admin/layouts/master')

@section('title')
    Pizza List
@endsection

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">


                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">

                            <h2 class="text-center title-2 row">
                                <a href="{{ route('product#edit', $pizza->id) }}" class="text-dark ms-3 fs-4  col-1 ">
                                    <i class="fa-solid fa-arrow-left"></i>
                                </a><span class="col-5 offset-3">Update Pizza</span>
                            </h2>
                            <hr>
                            <form action="{{ route('product#update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1 ">
                                        <input type="hidden" name="pizzaId" value="{{ $pizza->id }}">
                                        <img src="{{ asset('storage/' . $pizza->image) }}"
                                            class="img-thumbnail shadow-sm" />


                                        <div class="mt-3">
                                            <input type="file" name="pizzaImage" id=""
                                                class="form-control @error('pizzaImage') is-invalid @enderror">
                                            @error('pizzaImage')
                                                <div class="invalid-feedback"> {{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mt-3 col-7 offset-5 ">
                                            <button class="btn bg-dark text-white form-control" type="submit">
                                                <i class="fa-regular fa-floppy-disk me-2"></i>Update</button>
                                        </div>
                                    </div>


                                    <div class="col-6">
                                        <form action="" method="get" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label class="control-label mb-1 my-2 ">Name -</label>
                                                <input id="cc-pament" name="pizzaName" type="text"
                                                    class="form-control @error('pizzaName') is-invalid @enderror"
                                                    value="{{ old('pizzaName', $pizza->name) }}" aria-required="true"
                                                    aria-invalid="false" placeholder="Enter  pizza Name...">
                                                @error('pizzaName')
                                                    <div class="invalid-feedback"> {{ $message }}</div>
                                                @enderror
                                            </div>


                                            <div class="form-group">
                                                <label class="control-label mb-1 my-2 ">Description -</label>
                                                <textarea name="pizzaDescription" id="" cols="30" rows="10"
                                                    class="form-control @error('pizzaDescription') is-invalid @enderror" placeholder="enter Description">{{ old('pizzaDescription', $pizza->description) }}
                                                </textarea>

                                                @error('pizzaDescription')
                                                    <div class="invalid-feedback"> {{ $message }}</div>
                                                @enderror
                                            </div>


                                            <div class="form-group">
                                                <label class=" control-label mb-1 my-2 ">Category -</label>
                                                <select name="pizzaCategory" id=""
                                                    class="form-control @error('pizzaCategory') is-invalid @enderror">
                                                    <option value="">Choose the Category here...</option>
                                                    @foreach ($category as $c)
                                                        <option value="{{ $c->id }}"
                                                            @if ($pizza->category_id == $c->id) selected @endif>
                                                            {{ $c->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('pizzaCategory')
                                                    <div class="invalid-feedback"> {{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label mb-1 my-2 ">Price -</label>
                                                <input id="cc-pament" name="pizzaPrice" type="number"
                                                    class="form-control @error('pizzaPrice') is-invalid @enderror"
                                                    value="{{ old('pizzaPrice', $pizza->price) }}" aria-required="true"
                                                    aria-invalid="false" placeholder="Enter Price...">
                                                @error('pizzaPrice')
                                                    <div class="invalid-feedback"> {{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label mb-1 my-2 ">Waiting Time -</label>
                                                <input id="cc-pament" name="pizzaWaitingTime" type="number"
                                                    class="form-control @error('pizzaWaitingTime') is-invalid @enderror"
                                                    value="{{ old('pizzaWaitingTime', $pizza->waiting_time) }}"
                                                    aria-required="true" aria-invalid="false"
                                                    placeholder="Enter  waiting time...">
                                                @error('pizzaWaitingTime')
                                                    <div class="invalid-feedback"> {{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label mb-1 my-2 ">View Count -</label>
                                                <input id="cc-pament" name="viewCount" type="number"
                                                    class="form-control @error('viewCount') is-invalid @enderror"
                                                    value="{{ old('viewCount', $pizza->view_count) }}" aria-required="true"
                                                    aria-invalid="false" disabled>

                                            </div>

                                            <div class="form-group">
                                                <label class="control-label mb-1 my-2 ">Created Date -</label>
                                                <input id="cc-pament" name="created_at" type="text"
                                                    class="form-control @error('created_at') is-invalid @enderror"
                                                    value={{ $pizza->created_at->format('j-F-Y') }} aria-required="true"
                                                    aria-invalid="false" disabled>

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
