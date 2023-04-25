@extends('.admin.layouts.master')

@section('title')
    Users List
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
                                <h2 class="title-1">User Lists</h2>

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
                        <h4> Total- {{ $users->total() }}</h4>
                    </div>




                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <input type="hidden" class="userId" value="{{ $user->id }}">
                                        <td class="col-2">
                                            @if ($user->image == null)
                                                @if ($user->gender == 'male')
                                                    <img src="{{ asset('image/default_user.png') }}" class="img-thumbnail">
                                                @else
                                                    <img src="{{ asset('image/default_user_female.jpg') }}"
                                                        class="img-thumbnail">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/' . $user->image) }}" class="img-thumbnails">
                                            @endif
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->gender }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>
                                            <div class="form-group">

                                                <select name="role" id=""
                                                    class="form-select-sm mx-2 roleChg">Role-
                                                    <option value="admin"
                                                        @if ($user->role == 'admin') selected @endif>Admin
                                                    </option>
                                                    <option value="user"
                                                        @if ($user->role == 'user') selected @endif>User
                                                    </option>
                                                </select>
                                            </div>
                                        </td>
                                        <td class="">
                                            <a href="{{ route('admin#UserDelete', $user->id) }}" class="col">
                                                <button class="item me-2 roleChg" data-toggle="tooltip" data-placement="top"
                                                    title="Delete Account">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </a>
                                            <a href="{{ route('admin#UserEditPage', $user->id) }}" class="col mt-2">
                                                <button class="item me-2 roleChg" data-toggle="tooltip" data-placement="top"
                                                    title="Edit info ">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{-- {{ $a->appends(request()->query())->links() }} --}}
                            {{ $users->links() }}
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
