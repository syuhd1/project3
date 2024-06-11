<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
</head>
<body>
    
    <center>
        <h3>Customer name: {{$data->name}}</h3>
        <h3>Address: {{$data->address}}</h3>
        <h3>Phone: {{$data->phone}}</h3>

        <h2>Product: {{$data->product->title}}</h2>
        <h2>Total Price: {{$data->price}}</h2>

        <img height="100" width="100" src="products/{{$data->product->image}}" alt="">
    </center>
</body>
</html>