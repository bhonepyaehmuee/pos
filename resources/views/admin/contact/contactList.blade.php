@extends('.admin.layouts.master')

@section('title')
    Contact List
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
                                <h2 class="title-1">Messages</h2>
                            </div>
                        </div>


                    </div>
                    <div class="my-2">
                        {{-- <h4> Total- {{ $users->total() }}</h4> --}}
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($contact as $contact)
                                    <tr>

                                        <td>{{ $contact->id }}</td>
                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ Str::words($contact->message, 5, ' ..... ') }}
                                            <a href="{{ route('admin#contactDetails', $contact->id) }}">See more</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{-- {{ $a->appends(request()->query())->links() }} --}}
                            {{-- {{ $users->links() }} --}}
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
