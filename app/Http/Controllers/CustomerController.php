<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::latest()->paginate(20);

        return view('customers.index', compact('customers'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required|unique:customers',
            'email' => 'sometimes',
            'address_line1' => 'sometimes',
            'address_line2' => 'sometimes',
            'city' => 'sometimes',
            'state' => 'sometimes',
            'pincode' => 'sometimes',
        ]);

        Customer::create($request->all());

        return redirect()->route('customers.index')
            ->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        $orders = Order::where('customer_id', $customer->id)->latest()->paginate(10);
        return view('customers.show', compact('customer', 'orders'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'sometimes',
            'address_line1' => 'sometimes',
            'address_line2' => 'sometimes',
            'city' => 'sometimes',
            'state' => 'sometimes',
            'pincode' => 'sometimes',
        ]);

        $customer->update($request->all());

        return redirect()->route('customers.index')
            ->with('warning', 'Customer updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')
            ->with('danger', 'Customer deleted successfully');
    }

    public function getcustomerhistory($customer_id)
    {
        $customer = Customer::where('id', $customer_id)->first();
        $orders = Order::where('customer_id', $customer_id)->get();

        $paid_amount = 0;
        $total_amount = 0;
        foreach ($orders as $order) {
            $paid_amount = $paid_amount + $order->paid_amount;
            $total_amount = $total_amount + $order->total_amount;
        }
        $pending_amount = $total_amount - $paid_amount;
        $customer['pending_amount'] = $pending_amount;
        $customer['total_amount'] = $total_amount;
        $customer['paid_amount'] = $paid_amount;

        $vardata = "<h6>Name</h6>";
        $vardata .= "<p>$customer->name</p>";
        $vardata .= "<h6>Mobile</h6>";
        $vardata .= "<p>$customer->mobile</p>";
        $vardata .= "<h6>Email</h6>";
        $vardata .= "<p>$customer->email</p>";
        $vardata .= "<h5>Order Amount Details</h5>";
        $vardata .= "<h6>Total Amount</h6>";
        $vardata .= "<p>$customer->total_amount</p>";
        $vardata .= "<h6>Paid Amount</h6>";
        $vardata .= "<p>$customer->paid_amount</p>";
        $vardata .= "<h6>Pending Amount</h6>";
        $vardata .= "<p>$customer->pending_amount</p>";

        return $vardata;
    }
}
