@extends('.admin.layouts.master')

@section('title')
    Contact Details
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
                                {{-- <h2 class="title-1">Messages</h2> --}}
                            </div>
                        </div>

                    </div>
                    <div class="my-5  offset-7">
                        <h4> Total- {{ count($detail) }}</h4>
                    </div>

                    <div class="offset-2 fs-3 mb-2">
                        <a href="{{ route('admin#contactList') }}">
                            <i class="fa-solid fa-arrow-left text-dark"></i>
                            {{-- <span class="text-decoration-none">back</span> --}}
                        </a>
                    </div>

                    <div class="row   col-6 offset-2 shadow ">
                        <h2 class=" text-center my-4">Contact Details</h2>
                        <div class="">
                            @foreach ($detail as $d)
                                <div class="">
                                    <div for=""><span class="fw-bold my-2 p-3">ID</span> - {{ $d->id }}</div>
                                    <div for=""><span class="fw-bold my-2 p-3">Name</span> - {{ $d->name }}
                                    </div>
                                    <div for=""><span class="fw-bold my-2 p-3">Email</span> - {{ $d->email }}
                                    </div>
                                    <div for=""><span class="fw-bold my-2  p-3 pb-5">Message -</span><br>
                                        <p class="ps-3 pb-5 text-justify">{{ $d->message }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mt-3">
                        {{-- {{ $a->appends(request()->query())->links() }} --}}
                        {{-- {{ $users->links() }} --}}
                    </div>
                    {{-- </div> --}}

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
    </div>
@endsection
