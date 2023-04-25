@extends('.admin/layouts/master')

@section('title')
    Create Product List
@endsection

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-6 offset-3">
                    <a href="{{ route('product#list') }}" class="text-dark ms-3 fs-4 text-decoration-none">
                        <div class="my-2 me-2">
                            <i class="fa-solid fa-arrow-left me-2"></i><span class="">Back</span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Create your Pizza</h3>
                        </div>
                        <hr>
                        <form action="{{ route('product#create') }}" method="post" novalidate="novalidate"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1 ">Name</label>
                                <input id="cc-pament" name="pizzaName" type="text"
                                    class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true"
                                    aria-invalid="false" placeholder="Enter your Product Name"
                                    value="{{ old('pizzaName') }}">

                                @error('pizzaName')
                                    <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1 ">Category</label>
                                <select name="pizzaCategory" id=""
                                    class="form-control @error('pizzaCategory') is-invalid @enderror">
                                    <option value="">Choose Your Category</option>
                                    @foreach ($categories as $c)
                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                </select>

                                @error('pizzaCategory')
                                    <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1 ">Description</label>
                                <textarea name="pizzaDescription" class="form-control @error('pizzaDescription') is-invalid @enderror" cols="30"
                                    rows="10" placeholder="You can add the description about Pizza...">{{ old('pizzaDescription') }}</textarea>

                                @error('pizzaDescription')
                                    <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1 ">Image</label>
                                <input type="file" name="pizzaImage"
                                    class="form-control @error('pizzaImage') is-invalid @enderror">

                                @error('pizzaImage')
                                    <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1 ">Waiting Time in minutes</label>
                                <input id="cc-pament" name="pizzaWaitingTime" type="number"
                                    class="form-control @error('pizzaWaitingTime') is-invalid @enderror"
                                    aria-required="true" aria-invalid="false" placeholder="enter waiting time..."
                                    value="{{ old('pizzaWaitingTime') }}">

                                @error('pizzaWaitingTime')
                                    <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1 ">Price</label>
                                <input id="cc-pament" name="pizzaPrice" type="number"
                                    class="form-control @error('pizzaPrice') is-invalid @enderror" aria-required="true"
                                    aria-invalid="false" placeholder="Enter price..." value="{{ old('pizzaPrice') }}">

                                @error('pizzaPrice')
                                    <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>


                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Create</span>

                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
                            </div>
                        </form>
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
