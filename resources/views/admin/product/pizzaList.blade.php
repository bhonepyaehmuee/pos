@extends('.admin.layouts.master')

@section('title')
    Products List
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
                                <h2 class="title-1">Product List</h2>

                            </div>

                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('product#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>Add Product
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>
                    {{-- Data Search --}}
                    <form action="{{ route('product#list') }}" method="get">
                        @csrf
                        <div class="my-2">
                            <h4 class="text-secondary">Search Key: <span class="text-danger">{{ request('key') }}</span>
                            </h4>
                        </div>
                        <div class="">
                            <input class="au-input au-input--xl" type="text" name="key"
                                placeholder="Search for datas &amp; reports..." value="{{ request('key') }}" />
                            <a href="">
                                <button class="btn btn-primary  " type="submit">
                                    <i class="zmdi zmdi-search "></i>
                                </button>
                            </a>
                        </div>
                    </form>
                    <div class="my-2">
                        <h4> Total- {{ $pizzas->total() }}</h4>
                    </div>



                    {{-- message  --}}
                    @if (session('createSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-check"></i> {{ session('createSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if (session('deleteSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-check"></i>{{ session('deleteSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if (count($pizzas) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>

                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th>View Count</th>
                                        <th></th>
                                </thead>
                                <tbody>

                                    @foreach ($pizzas as $p)
                                        <tr class="tr-shadow ">
                                            <td class="col-3"> <img src="{{ asset('storage/' . $p->image) }}"
                                                    class="img-thumbnail shadow-sm">
                                            </td>
                                            <td class="col-3">
                                                <p>{{ $p->name }}</p>
                                            </td>
                                            <td class="col-3">{{ $p->price }}</td>
                                            <td class="col-3">{{ $p->category_name }}</td>
                                            <td class="col-3"><i class="fa-solid fa-eye"></i>{{ $p->view_count }}</td>

                                            {{-- <td> {{ $category->created_at->format('j-F-y') }} </td> --}}
                                            <td class="col-3">
                                                <div class="table-data-feature">


                                                    <a href="{{ route('product#updatePage', $p->id) }}">

                                                        <button class="item mx-2" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('product#edit', $p->id) }}">
                                                        <button class="item me-2" data-toggle="tooltip" data-placement="top"
                                                            title="view">
                                                            <i class="fa-solid fa-binoculars"></i>
                                                        </button>
                                                    </a>



                                                    <a href="{{ route('product#delete', $p->id) }}">
                                                        <button class="item " data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $pizzas->appends(request()->query())->links() }}
                            </div>
                        </div>
                    @else
                        <h3 class="text-danger text-center mt-3">There is no data you entered!!</h3>
                    @endif
                    <!-- END DATA TABLE -->

                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
    </div>
@endsection
