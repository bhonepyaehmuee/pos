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
                                <h2 class="title-1">Order List</h2>

                            </div>

                        </div>

                    </div>

                    <div class="my-2">
                        <h4> Total- {{ count($order) }}</h4>
                    </div>

                    <form action="{{ route('admin#orderchangeStatus') }}" method="get">
                        @csrf
                        <div class="d-flex ">
                            <label for="" class="mt-2">By Order Status -</label>
                            <select name="orderStatus" id="orderStatus" class="form-select col-3 ms-2">
                                <option value="">All</option>
                                <option value="0" @if (request('orderStatus') == '0') selected @endif>Pending</option>
                                <option value="1" @if (request('orderStatus') == '1') selected @endif> Accept</option>
                                <option value="2" @if (request('orderStatus') == '2') selected @endif>Reject</option>
                            </select>
                            <button type="submit" class="btn  btn-sm bg-dark text-white ms-3 rounded ">Search</button>
                        </div>
                    </form>

                    {{-- @if (count($pizzas) != 0) --}}
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>Order Code</th>
                                    <th>Total Amount</th>
                                    <th>Order Date</th>
                                    <th>Status</th>
                                    {{-- <th></th> --}}
                                </tr>
                            </thead>
                            <tbody id="dataList">

                                {{-- <td> {{ $category->created_at->format('j-F-y') }} </td> --}}
                                @foreach ($order as $o)
                                    <tr class="tr-shadow ">
                                        <input type="hidden" class="orderId" value="{{ $o->id }}">
                                        <td class="">
                                            {{ $o->user_id }}
                                        </td>
                                        <td class="">
                                            {{ $o->user_name }}
                                        </td>
                                        <td class="text-outline-none">
                                            <a href="{{ route('admin#listInfo', $o->order_code) }}">
                                                {{ $o->order_code }}</a>
                                        </td>
                                        <td class="amount">
                                            {{ $o->total_price }}
                                        </td>
                                        <td class="">
                                            {{ $o->created_at->format('d-m-Y') }}
                                        </td>

                                        <td class="">
                                            <select name="status" class="form-select statusChange">
                                                <option value="0" @if ($o->status == 0) selected @endif>
                                                    Pending</option>
                                                <option value="1" @if ($o->status == 1) selected @endif>
                                                    Accept</option>
                                                <option value="2" @if ($o->status == 2) selected @endif>
                                                    Reject</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{-- {{ $pizzas->appends(request()->query())->links() }} --}}
                        </div>
                    </div>
                    {{-- @else
                        <h3 class="text-danger text-center mt-3">There is no data you entered!!</h3>
                    @endif --}}
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
            // $('#orderStatus').change(function() {
            //     $status = $('#orderStatus').val();
            //     // console.log($status);
            //     $.ajax({
            //         type: 'get',
            //         url: '/order/ajax/status',
            //         dataType: 'json',
            //         data: {
            //             'status': $status,
            //         },
            //         success: function(resp) {
            //             $list = '';
            //             for ($i = 0; $i < resp.length; $i++) {

            //                 // 2023-04-02T14:45:44.000000Z { database}
            //                 // Sun Apr 02 2023 21:15:44 GMT+0630 (Myanmar Time) (after change)
            //                 $months = ['January', 'February', 'March', 'April', 'May', 'June',
            //                     'July', 'August', 'September', 'October', 'November',
            //                     'December'
            //                 ];
            //                 // console.log(resp[$i].created_at);
            //                 // change datetime from the database to Date format of javascript
            //                 $dbDate = new Date(resp[$i].created_at);
            //                 $finalDate = $months[$dbDate.getMonth()] + "-" + $dbDate.getDate() +
            //                     "-" + $dbDate.getFullYear();

            //                 if (resp[$i].status == 0) {
            //                     $statusMessage = `
        //                                 <select name="status" class="form-select statusChange ">
        //                                     <option value="0" selected>
        //                                         Pending</option>
        //                                     <option value="1" >
        //                                         Accept</option>
        //                                     <option value="2" >
        //                                         Reject</option>
        //                                 </select>
        //                 `
            //                 } else if (resp[$i].status == 1) {
            //                     $statusMessage = `
        //                                 <select name="status" class="form-select statusChange ">
        //                                     <option value="0" >
        //                                         Pending</option>
        //                                     <option value="1" selected>
        //                                         Accept</option>
        //                                     <option value="2" >
        //                                         Reject</option>
        //                                 </select>
        //                 `
            //                 } else if (resp[$i].status == 2) {
            //                     $statusMessage = `
        //                                 <select name="status" class="form-select statusChange ">
        //                                     <option value="0" >
        //                                         Pending</option>
        //                                     <option value="1" >
        //                                         Accept</option>
        //                                     <option value="2" selected>
        //                                         Reject</option>
        //                                 </select>
        //                 `
            //                 };


            //                 $list += `
        //              <tr class="tr-shadow ">
        //                             <input type="hidden" class="orderId" value="${resp[$i].id}">
        //                             <td class="">
        //                                 ${resp[$i] . user_id}
        //                             </td>
        //                             <td class="">
        //                                 ${resp[$i] . user_name} || ${resp[$i].id}
        //                             </td>
        //                             <td class="">
        //                                ${resp[$i] . order_code}
        //                             </td>
        //                             <td class="amount">
        //                                ${resp[$i] . total_price}
        //                             </td>
        //                             <td class="">
        //                                   ${ $finalDate}
        //                             </td>

        //                             <td>${$statusMessage}
        //                              </td>
        //                         </tr>
        //             `;
            //             }
            //             $(
            //                 '#dataList'
            //             ).html($list);
            //         }
            //     })
            // })


            // change status( accept, reject,pending)
            $('.statusChange').change(function() {
                $currentStatus = $(this).val();
                $parentNode = $(this).parents("tr");
                $orderId = $parentNode.find('.orderId').val();
                $data = {
                    'orderId': $orderId,
                    'status': $currentStatus,

                };
                console.log($data);
                $.ajax({
                    type: 'get',
                    dataType: 'json',
                    data: $data,
                    url: '/order/ajax/change/status'
                })
                // window.location.href = "/order/list"
            })
        });
    </script>
@endsection
