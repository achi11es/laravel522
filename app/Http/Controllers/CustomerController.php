<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


//use App\Http\Requests;
use App\Customer;
use App\Stock;

class CustomerController extends Controller
{
    public function index()
    {
        //
        $customers=Customer::all();
        return view('customers.index',compact('customers'));
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);
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

        return view('customers.show',compact('customer','stockval'));
    }


    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $customer= new Customer($request->all());
        $customer->save();
        return redirect('customers');
    }

    public function edit($id)
    {
        $customer=Customer::find($id);
        return view('customers.edit',compact('customer'));
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
        $customer= new Customer($request->all());
        $customer=Customer::find($id);
        $customer->update($request->all());
        return redirect('customers');
    }

    public function destroy($id)
    {
        Customer::find($id)->delete();
        return redirect('customers');
    }

    public function stringify($id)
    {
        // $customer=Customer::where('id', $id)->select('customer_id','name','address','city','state','zip','home_phone','cell_phone')->first();
        $customer = Customer::where('cust_number', $id)->select('cust_number','name','address','city','state','zip','home_phone','cell_phone')->first();

        $customer = $customer->toArray();
        return response()->json($customer);
    }

}
