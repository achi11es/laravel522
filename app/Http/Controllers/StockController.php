<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Stock;
use App\Customer;

class StockController extends Controller
{
    public function index()
    {

        $stocks=Stock::all();
        $stockval = Array();
        foreach($stocks as $stock) {


            $url = ('http://finance.google.com/finance/info?client=ig&q=NASDAQ%3A' . $stock->symbol);

            $file = fopen("$url", "r");
            $r = "";
            do {
                $data = fread($file, 500);
                $r .= $data;
            } while (strlen($data) != 0);

            $json = str_replace("\n", "", $r);
            $data = substr($json, 4, strlen($json) - 5);
            $json_output = json_decode($data, true);
            //dd($json_output);
            array_push($stockval, $json_output['l']);

        }
        return view('stocks.index',compact('stocks','stockval'));
    }

    public function show($id)
    {

        $stock = Stock::findOrFail($id);

        return view('stocks.show',compact('stock'));
    }


    public function create()
    {

        $customers = Customer::lists('name','id');
        return view('stocks.create', compact('customers'));
    }

   /*public function currentValue($stock)
    {
        $url = ('http://finance.google.com/finance/info?client=ig&q=NASDAQ%3A'.$stock->symbol);
        $json = file_get_contents($url);
        $data = json_decode($json,true);
        $stockval = $data['l_curr'];
        return view('stocks.index',compact('stockval'));

    } */

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

        $stock= new Stock($request->all());
        $stock->save();

        return redirect('stocks');
    }

    public function edit($id)
    {
        $stock=Stock::find($id);
        return view('stocks.edit',compact('stock'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id,Request $request)
    {
        //
        $stock= new Stock($request->all());
        $stock=Stock::find($id);
        $stock->update($request->all());
        return redirect('stocks');
    }

    public function destroy($id)
    {
        Stock::find($id)->delete();
        return redirect('stocks');
    }

}
