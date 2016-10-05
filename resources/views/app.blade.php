<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FinServ</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

</head>
<body>
<div class="container" style="justify-content: center">
    <a href="{{ action('CustomerController@index') }}" style="font-size: x-large">CUSTOMERS |</a>
    <a href="{{ action('StockController@index') }}" style="font-size: x-large"> STOCKS |</a>
    <a href="{{ action('InvestmentController@index') }}" style="font-size: x-large"> INVESTMENTS</a>
</div>
<hr>
<div class="container">
    @yield('content')
</div>
</body>
</html>
