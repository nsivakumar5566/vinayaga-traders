<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Variant;
use Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::latest()->paginate(20);

        return view('orders.index', compact('orders'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $customers = Customer::all();
        return view('orders.create', compact('products', 'customers'));
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
            'customer_id' => 'required',
            'order_date' => 'required',
            'product_id' => 'required',
            'variant_id' => 'required',
            'qty' => 'required',
            'price' => 'required',
            'deliver_charge' => 'required',
            'extra_charge' => 'required',
            'paid_amount' => 'sometimes',
            'total_amount' => 'required',
            'fully_paid' => 'required',
        ]);

        if (!$request->extra_charge) {
            $request['extra_charge'] = 0;
        }

        if ($request->fully_paid == 1) {
            $paid_amount = $request->total_amount;
        } else {
            $paid_amount = $request->paid_amount;
        }

        // 'order_date', 'order_created_by', 'customer_id', 'deliver_charge', 'extra_charge', 'paid_amount', 'fully_paid', 'total_amount'
        $order = new Order;
        $order->order_date = $request->order_date;
        $order->order_created_by = Auth::user()->id;
        $order->customer_id = $request->customer_id;
        $order->deliver_charge = $request->deliver_charge;
        $order->extra_charge = $request->extra_charge;
        $order->paid_amount = $paid_amount;
        $order->total_amount = $request->total_amount;
        $order->fully_paid = $request->fully_paid;
        $order->save();

        for ($i = 0; $i < count($request->product_id); $i++) {
            $product_id = $request->product_id[$i];
            $variant_id = $request->variant_id[$i];
            $qty = $request->qty[$i];
            $price = $request->price[$i];

            $product = Product::find($product_id);
            $product_name = $product->name;

            $variant = Variant::find($variant_id);
            $variant_name = $variant->variant;

            // 'order_id', 'product_id', 'product_name', 'variant_id', 'variant', 'qty', 'price',
            $orderItem = new OrderItem;
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $product_id;
            $orderItem->product_name = $product_name;
            $orderItem->variant_id = $variant_id;
            $orderItem->variant = $variant_name;
            $orderItem->qty = $qty;
            $orderItem->price = $price;
            $orderItem->save();
        }

        return redirect()->route('orders.index')
            ->with('success', 'Order created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $customer = Customer::where('id', $order->customer_id)->first();
        $items = OrderItem::where('order_id', $order->id)->get();
        $order['pending_amount'] = $order->total_amount - $order->paid_amount;
        return view('orders.show', compact('order', 'items', 'customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $products = Product::all();
        $variants = Variant::all();
        $customers = Customer::all();
        $items = OrderItem::where('order_id', $order->id)->get();
        return view('orders.edit', compact('order', 'products', 'customers', 'items', 'variants'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'customer_id' => 'required',
            'order_date' => 'required',
            'product_id' => 'required',
            'variant_id' => 'required',
            'qty' => 'required',
            'price' => 'required',
            'deliver_charge' => 'required',
            'extra_charge' => 'required',
            'paid_amount' => 'sometimes',
            'total_amount' => 'required',
            'fully_paid' => 'required',
        ]);

        if (!$request->extra_charge) {
            $request['extra_charge'] = 0;
        }

        if ($request->fully_paid == 1) {
            $paid_amount = $request->total_amount;
        } else {
            $paid_amount = $request->paid_amount;
        }

        $order->order_date = $request->order_date;
        $order->order_created_by = Auth::user()->id;
        $order->customer_id = $request->customer_id;
        $order->deliver_charge = $request->deliver_charge;
        $order->extra_charge = $request->extra_charge;
        $order->paid_amount = $paid_amount;
        $order->total_amount = $request->total_amount;
        $order->fully_paid = $request->fully_paid;
        $order->save();

        return redirect()->route('orders.index')
            ->with('warning', 'Order updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $orderItems = OrderItem::where('order_id', $order->id)->get();
        foreach ($orderItems as $item) {
            $item->delete();
        }
        $order->delete();

        return redirect()->route('orders.index')
            ->with('danger', 'Order deleted successfully');
    }
}
