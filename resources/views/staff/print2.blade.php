<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 13px; /* Reduce font size */
            background-color: white;
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
            background-color: #f2f2f2;
        }

        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <h1>Order History Report</h1>
    
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
            @foreach ($orders as $order)
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
            @endforeach
        </table>
    </div>
</body>

</html>
