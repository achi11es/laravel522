@extends('app')

@section('content')
    <h1>Customer </h1>

    <div class="container">
        <table class="table table-striped table-bordered table-hover">
            <tbody>
            <tr class="bg-info">
            <tr>
                <td>Name</td>
                <td><?php echo ($customer['name']); ?></td>
            </tr>
            <tr>
                <td>Cust Number</td>
                <td><?php echo ($customer['cust_number']); ?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><?php echo ($customer['address']); ?></td>
            </tr>
            <tr>
                <td>City </td>
                <td><?php echo ($customer['city']); ?></td>
            </tr>
            <tr>
                <td>State</td>
                <td><?php echo ($customer['state']); ?></td>
            </tr>
            <tr>
                <td>Zip </td>
                <td><?php echo ($customer['zip']); ?></td>
            </tr>
            <tr>
                <td>Home Phone</td>
                <td><?php echo ($customer['home_phone']); ?></td>
            </tr>
            <tr>
                <td>Cell Phone</td>
                <td><?php echo ($customer['cell_phone']); ?></td>
            </tr>


            </tbody>
        </table>
    </div>



<?php
$stockprice=null;
$stotal = 0;
$svalue=0;
$itotal = 0;
$ivalue=0;

$i=0;
?>
<br>
<h2>Stocks </h2>
<div class="container">
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr class="bg-info">
            <th> Symbol </th>
            <th>Stock Name</th>
            <th>No. of Shares</th>
            <th>Purchase Price</th>
            <th>Purchase Date</th>
            <th>Original Value</th>
            <th>Current Price</th>
            <th>Current Value</th>
        </tr>
        </thead>

        <tbody>




        @foreach($customer->stocks as $stock)
            <tr>
                <td>{{ $stock->symbol }}</td>
                <td>{{ $stock->name }}</td>
                <td>{{ $stock->shares }}</td>
                <td>{{ $stock->purchase_price }}</td>
                <td>{{ $stock->purchased }}</td>
                <?php $ivalue = $stock->shares * $stock->purchase_price ?>
                <?php $itotal += $ivalue ?>
                <td>{{ $stock->shares * $stock->purchase_price  }}</td>
                <?php $stockprice = $stockval[$i++]?>
                <td>{{ $stockprice}}</td>
                <?php $svalue = $stockprice * $stock->shares ?>
                <td>{{ $svalue }}</td>
                <?php $stotal += $svalue ?>
            </tr>

        @endforeach
    </table>
        <h4>
            <?php echo 'Initial Stocks Portfolio value $', number_format($itotal,2);?>
            <br>
            <?php echo 'Total Current Stock Portfolio $',number_format($stotal,2)?>
        </h4>
        </tbody>

</div>

    <?php
    $invtotal = 0;
    $cinvtotal = 0;

    ?>
    <br>
    <h2>Investments </h2>
    <div class="container">
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr class="bg-info">
                <th> Category </th>
                <th>Description</th>
                <th>Acquired Value</th>
                <th>Acquired Date</th>
                <th>Current Value</th>
                <th>Current Date</th>
            </tr>
            </thead>

            <tbody>




            @foreach($customer->investments as $investment)
                <tr>
                    <td>{{ $investment->category }}</td>
                    <td>{{ $investment->description }}</td>
                    <td>{{ $investment->acquired_value }}</td>
                    <td>{{ $investment->acquired_date }}</td>
                    <?php $invtotal += $investment->acquired_value ?>
                    <td>{{ $investment->recent_value }}</td>
                    <td>{{ $investment->recent_date }}</td>
                    <?php $cinvtotal += $investment->recent_value ?>
                </tr>

            @endforeach
        </table>
        <h4>
            <?php echo 'Initial investments portfolio value $', number_format($invtotal,2);?>
            <br>
            <?php echo 'Total current investments portfolio value $',number_format($cinvtotal,2)?>
        </h4>
        </tbody>

    </div>

    <div>
        <h3>
            <?php echo 'Initial portfolio value $', number_format($invtotal+$itotal,2);?>
            <br>
            <?php echo 'Total current investments portfolio value $',number_format($cinvtotal+$stotal,2)?>
        </h3>
    </div>


@stop
