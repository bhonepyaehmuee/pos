@extends('.admin.layouts.master')

@section('title')
    Admin List
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
                                <h2 class="title-1">Admin List</h2>

                            </div>
                        </div>

                    </div>
                    {{-- Data Search --}}
                    <form action="{{ route('admin#list') }}" method="get">
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
                        <h4> Total- {{ $admin->total() }}</h4>
                    </div>

                    {{-- message  --}}

                    @if (session('roleChange'))
                        <div class="col-9 offset-3">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-check"></i> {{ session('roleChange') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif


                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admin as $a)
                                    <tr class="tr-shadow">
                                        <input type="hidden" class="userId" value="{{ $a->id }}">
                                        <td>{{ $a->id }}</td>
                                        <td class="col-2">
                                            @if ($a->image == null)
                                                @if ($a->gender == 'female')
                                                    <img src="{{ asset('image/default_user_female.jpg') }}"
                                                        class="img-thumbnail shadow-sm" alt="">
                                                @else
                                                    <img src="{{ asset('image/default_user.png') }}"
                                                        class="img-thumbnail shadow-sm" alt="">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/' . $a->image) }}"
                                                    class="img-thumbnail shadow-sm" alt="">
                                            @endif
                                        </td>
                                        <td>{{ $a->name }}</td>
                                        <td>{{ $a->email }}</td>
                                        <td>{{ $a->gender }}</td>
                                        <td>{{ $a->phone }}</td>
                                        <td>{{ $a->address }}</td>
                                        <td class="col-3">
                                            <div class="table-data-feature">
                                                {{-- condition for to delete the other admin acc but not for its own account --}}
                                                {{-- first way --}}
                                                {{-- <a
                                                    href="@if (Auth::user()->id == $a->id) @else {{ route('admin#delete') }} @endif">
                                                    <button class="item " data-toggle="tooltip" data-placement="top"
                                                        title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </a> --}}
                                                @if (Auth::user()->id == $a->id)
                                                @else
                                                    {{-- <a href="{{ route('admin#changeRole', $a->id) }}"> --}}
                                                    {{-- <button class="item me-2 roleChg" data-toggle="tooltip"
                                                        data-placement="top" title="Change Admin Role ">
                                                        <i class="fa-solid fa-arrow-right-arrow-left"></i>
                                                    </button> --}}
                                                    <div class="form-group">

                                                        <select name="role" id=""
                                                            class="form-select-sm mx-2 roleChg">Role-
                                                            <option value="admin"
                                                                @if ($a->role == 'admin') selected @endif>Admin
                                                            </option>
                                                            <option value="user"
                                                                @if ($a->role == 'user') selected @endif>User
                                                            </option>
                                                        </select>
                                                    </div>
                                                    {{-- </a> --}}
                                                    <a href=" {{ route('admin#delete', $a->id) }}">
                                                        <button class="item " data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                @endif



                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{-- {{ $a->appends(request()->query())->links() }} --}}
                            {{ $admin->links() }}
                        </div>
                    </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
    </div>
@endsection

@section('scriptSection')
    <script>
        $(document).ready(function() {
            $('.roleChg').change(function() {
                $changeRole = $(this).val();
                $parentNode = $(this).parents('tr');
                $userId = $parentNode.find('.userId').val();
                $data = {
                    'changeRole': $changeRole,
                    'userId': $userId
                };
                console.log($data);

                $.ajax({
                    type: 'get',
                    dataType: 'json',
                    data: $data,
                    url: '/admin/ajax/change/role',
                });
                location.reload();

            })
        });
    </script>
@endsection
