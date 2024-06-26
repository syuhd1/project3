<!DOCTYPE html>
<html>
<head>
    @include('staff.css')
    <style>
        .div_deg {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 15px;
            margin-bottom: 15px;
            flex-direction: column;
        }
        .table_deg {
            max-width: 200px;
            /* border: 2px solid greenyellow; */
        }
        td {
            /* color: white; */
        }
        .top-right {
            background-color: #007bff; /* Blue color */
            color: white;
            padding: 10px 20px;
            margin-left: 170px;
            text-decoration: none;
            border-radius: 5px;
            align-self: flex-end;
        }
        .top-left {
            /* display: flex; */
            /* align-items: center; */
            align-self: flex-start;
        }
        input[type='search'] {
            width: 500px;
            height: 40px;
            margin-right: 10px;
            padding: 5px 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            align-self: flex-start;
        }
        .boxbtn-vertical {
            text-align: center;
            vertical-align: middle;
        }
        .pagination-wrapper {
            margin-top: 20px;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    @include('staff.header')
    @include('staff.sidebar')
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h2>Manage Quotation</h2>
                <div class="col-lg-12">
                    <div class="block">
                        <div class="div_deg">
                            <form action="{{ url('staff/order_search') }}" method="get" class="top-left">
                                @csrf
                                <input type="search" name="search" placeholder="Search..." />
                                <input type="submit" class="btn btn-secondary" value="Search" />
                            </form>
                        </div>
                        <div class="table-responsive">
                            @include('staff.colormap')
                            <table class="table table-striped table-hover table_deg" >
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Customer</th>
                                        <th>Phone</th>
                                        <!-- <th>Address</th> -->
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Quantity</th>
                                        <th>Base Value (RM)</th>
                                        <th>Product</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $quote)
                                    <tr>
                                        <td>{{ $quote->id }}</td>
                                        <td>{{ $quote->name }}</td>
                                        <td>{{ $quote->phone }}</td>
                                        <!-- <td>{{ $quote->address }}</td> -->
                                        <td>{!!Str::limit($quote->description,50)!!}</td>
                                        <td>{{ $quote->status }}</td>
                                        <td>{{ $quote->quantity }}</td>
                                        
                                        <td>{{ $quote->base_price * $quote->quantity }}</td>
                                        <td>
                                            <span>{{ $quote->product->title }}</span>
                                            <img height="70" width="70" src="products/{{$quote->product->image}}" alt="" />
                                        </td>
                                        <td class="boxbtn-vertical">
                                            <a class="btn btn-primary" href="{{url('staff/update_quotation', $quote->id)}}">Details</a>
                                            <!-- <a class="btn btn-danger" onclick="confirmation(event)" href="{{ url('staff/delete_order', $quote->id) }}">Delete</a> -->
                                            <!-- <a class="btn btn-secondary" href="{{url('staff/print_pdf', $quote->id)}}">Print</a> -->
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="div_deg pagination-wrapper">
                            {{ $data->onEachSide(1)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        // function confirmation(ev) {
        //     ev.preventDefault();
        //     var urlToRedirect = ev.currentTarget.getAttribute('href');
        //     console.log(urlToRedirect);

        //     swal({
        //         title: "Are you sure to delete this?",
        //         text: "This deletion will be permanent",
        //         icon: "warning",
        //         buttons: true,
        //         dangerMode: true,
        //     }).then((willCancel) => {
        //         if (willCancel) {
        //             window.location.href = urlToRedirect;
        //         }
        //     });
        // }

        // function updateStatus(orderId) {
        //     var selectedStatus = document.getElementById('status-' + orderId).value;
        //     var hiddenSelect = document.querySelector('#update-form-' + orderId + ' select[name="status"]');
        //     hiddenSelect.value = selectedStatus;
        // }

        // function submitForm(orderId) {
        //     document.getElementById('update-form-' + orderId).submit();
        // }
    </script>
    <script src="{{ asset('admincss/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('admincss/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admincss/js/charts-home.js') }}"></script>
    <script src="{{ asset('admincss/js/front.js') }}"></script>
</body>
</html>
