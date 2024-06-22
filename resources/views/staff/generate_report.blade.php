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
        .dropdown-container {
            display: flex;
            align-items: center;
        }
        .dropdown-container select {
            margin-right: 10px;
            padding: 5px;
        }
        .dropdown-container button {
            padding: 5px 10px;
        }
    </style>
</head>
<body>
    @include('staff.header')
    @include('staff.sidebar')
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h2>Generate Report</h2>
                <div class="col-lg-12">
                    <div class="block">
                        <!-- <div class="div_deg">
                            <form action="{{ url('staff/order_search') }}" method="get" class="top-left">
                                @csrf
                                <input type="search" name="search" placeholder="Search..." />
                                <input type="submit" class="btn btn-secondary" value="Search" />
                            </form>
                        </div> -->
                        <div class="table-responsive">
                        <div class="div_deg dropdown-container">
                            <form action="{{ url('staff/print_pdf') }}" method="get">
                                @csrf
                                <label for="">Please select time range : </label>
                                <select name="timeline">
                                    <option value="today">Today</option>
                                    <option value="last_7_days">Last 7 Days</option>
                                    <option value="this_month">This Month</option>
                                    <option value="all_time">All Time</option>
                                </select>
                                <button type="submit" class="btn btn-success">Generate Report</button>
                            </form>
                        </div>

                            <!-- <table class="table table-striped table-hover table_deg">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Date</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $report)
                                    <tr>
                                        <td>{{ $report->id }}</td>
                                        <td>{{ $report->title }}</td>
                                        <td>{{ $report->created_at }}</td>
                                        <td class="boxbtn-vertical">
                                        <a class="btn btn-secondary" href="{{url('staff/view_pdf', $report->id)}}">View</a>
                                            <a class="btn btn-success" href="{{url('staff/print_pdf', $report->id)}}">Print</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                        </div>
                        
                        <div class="div_deg pagination-wrapper">
                            {{ $data->onEachSide(1)->links() }}
                        </div> -->

                        <!-- <div>
                                <a class="btn btn-success" href="{{url('staff/print2')}}">Print2</a>
                        </div>  -->
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
