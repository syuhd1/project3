<!DOCTYPE html>
<html>
<head>
    @include('admin.css')
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
    @include('admin.header')
    @include('admin.sidebar')
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h2>Manage Order</h2>
                <div class="col-lg-12">
                    <div class="block">
                        <div class="div_deg">
                            <form action="{{ url('order_search') }}" method="get" class="top-left">
                                @csrf
                                <input type="search" name="search" placeholder="Search..." />
                                <input type="submit" class="btn btn-secondary" value="Search" />
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table_deg">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Customer</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Quantity</th>
                                        <th>Size</th>
                                        <th>Color</th>
                                        <th>Total Price (RM)</th>
                                        <th>Product</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->phone }}</td>
                                        <td>{{ $order->address }}</td>
                                        <td>
                                            <form id="update-form-{{ $order->id }}" action="{{ url('update_order', $order->id) }}" method="POST">
                                                @csrf
                                                <select name="status" class="hidden">
                                                    <option value="in progress" {{ $order->status == 'in progress' ? 'selected' : '' }}>In Progress</option>
                                                    <option value="in production" {{ $order->status == 'in production' ? 'selected' : '' }}>In Production</option>
                                                    <option value="to be delivered" {{ $order->status == 'to be delivered' ? 'selected' : '' }}>To Be Delivered</option>
                                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                </select>
                                            </form>
                                            <div class="input_deg">
                                                <select id="status-{{ $order->id }}" onchange="updateStatus({{ $order->id }})">
                                                    <option value="">Select a status</option>
                                                    <option value="in progress" {{ $order->status == 'in progress' ? 'selected' : '' }}>In Progress</option>
                                                    <option value="in production" {{ $order->status == 'in production' ? 'selected' : '' }}>In Production</option>
                                                    <option value="to be delivered" {{ $order->status == 'to be delivered' ? 'selected' : '' }}>To Be Delivered</option>
                                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>{{ $order->quantity }}</td>
                                        <td>{{ $order->size }}</td>
                                        <td>{{ $order->color }}</td>
                                        <td>{{ $order->price }}</td>
                                        <td>
                                            <span>{{ $order->product->title }}</span>
                                            <img height="70" width="70" src="products/{{ $order->product->image }}" alt="" />
                                        </td>
                                        <td class="boxbtn-vertical">
                                            <button class="btn btn-secondary" onclick="submitForm({{ $order->id }})">Update</button>
                                            <a class="btn btn-danger" onclick="confirmation(event)" href="{{ url('delete_order', $order->id) }}">Delete</a>
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
        function confirmation(ev) {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            console.log(urlToRedirect);

            swal({
                title: "Are you sure to delete this?",
                text: "This deletion will be permanent",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willCancel) => {
                if (willCancel) {
                    window.location.href = urlToRedirect;
                }
            });
        }

        function updateStatus(orderId) {
            var selectedStatus = document.getElementById('status-' + orderId).value;
            var hiddenSelect = document.querySelector('#update-form-' + orderId + ' select[name="status"]');
            hiddenSelect.value = selectedStatus;
        }

        function submitForm(orderId) {
            document.getElementById('update-form-' + orderId).submit();
        }
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
