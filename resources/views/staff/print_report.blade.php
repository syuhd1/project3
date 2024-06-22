<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 13px; /* Reduce font size */
            background-color: white;
        }

        .company-info {
            border: 4px solid black;
            margin-bottom: 20px;
            padding: 20px;
        }

        .company-info h2 {
            margin: 0;
        }

        .company-info p {
            margin: 5px 0;
        }

        .table-container {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            max-width: 100%;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 5px; /* Reduce padding */
            text-align: left;
        }

        th {
            background-color: skyblue;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .summary {
            border: 4px solid black;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            margin-top: 20px;
            font-weight: bold;
        }

        .summary span {
            margin: 5px 0;
        }
    </style>
</head>

<body>

    <div class="company-info">
        <h2>T-Hub: Shirt Printing Service System</h2>
        <p>Bangunan F3, Universiti Tun Hussein Onn Malaysia, 86400 Parit Raja, Johor</p>
        <p>Phone:  012-34567890</p>
        <p>Email: thub001@gmail.com</p>
        <p>Website: https://t-hub.xyz </p>

    </div>
    <h3>Order History Report</h3>
    
    <div class="table-container">
        <table>
            <tr>
                <th>Img</th>
                <th>Title</th>
                <th>Clr</th> <!-- Abbreviate headers -->
                <th>Sz</th>
                <th>Qty</th>
                <th>Cstmztn</th>
                <th>Price</th>
                <th>Addr</th>
                <th>Status</th>
                <th>Order Time</th>
                <th>Updated At</th>
            </tr>
            @php
                $income = 0; $count = 0; $quantity = 0;
            @endphp

            @foreach ($data as $order)
            
            <tr>
                <td><img width="60" src="{{ public_path('products/'.$order->product->image) }}" alt=""></td>
                <td>{{ $order->product->title }}</td>
                <td>{{ $order->color }}</td>
                <td>{{ $order->size }}</td>
                <td>{{ $order->quantity }}</td>
                <td>
                    @if ($order->quote_id !== null)
                    Quote ID: {{ $order->quote_id }}
                    @else
                    None
                    @endif
                </td>
                <td>{{ $order->total_price }}</td>
                <td>{{ $order->address }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->created_at }}</td>
                <td>{{ $order->updated_at }}</td>
            </tr>

            @php
                $income = $income + $order->total_price;
                $count++ ;
                $quantity = $quantity + $order->quantity;
                $income= number_format($income,2,'.','');
            @endphp

            @endforeach
        </table>
    </div>

    <div class="summary" >
            <span>
                Total income: RM{{$income}}     |  
            </span>
            <span>
                Total orders: {{$count}}     |  
            </span>
            <span>
                Total quantity sold: {{$quantity}} 
            </span>
    </div>
</body>

</html>
