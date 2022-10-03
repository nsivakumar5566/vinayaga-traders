@extends('layouts.app')
@section('title', 'Customers')
@section('content')

<main id="main" class="main">
    <!-- breadcrumb starts -->
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Orders</a></li>
                <li class="breadcrumb-item active">Show</li>
            </ol>
        </nav>
    </div> <!-- breadcrumb ends -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">Order No: #{{ $order->id }}</h5>
                            <div class="align-self-center">
                                <a href="{{ route('orders.edit', $order->id) }}" class="btn-custom">Edit</a>
                                <button id="delete-record" type="button" class="btn-custom" data-bs-toggle="modal"
                                    data-bs-target="#verticalycentered"
                                    data-id="{{ route('orders.destroy', $order->id) }}">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="print-order">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-center order-cmp-name">Vinayaga Traders</h5>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div class="customer-info">
                                <h4 class="customer-info-title">Customer Details</h4>
                                <p class="text-start">Name: {{ $customer->name }}</p>
                                <p class="text-start">Mobile: {{ $customer->mobile }}</p>
                                <p class="text-start">Email: {{ $customer->email }}</p>
                            </div>
                            <div class="customer-info">
                                <h4 class="customer-info-title text-end">Customer Address</h4>
                                <p class="text-end">{{ $customer->address_line1 }}</p>
                                <p class="text-end">{{ $customer->address_line2 }}</p>
                                <p class="text-end">{{ $customer->city }}, {{ $customer->state }}, {{ $customer->pincode
                                    }}</p>
                            </div>
                        </div>
                        <hr>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 50px;">#</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Variant Name</th>
                                    <th scope="col" style="width: 150px;" class="text-center">Quantity</th>
                                    <th scope="col" style="width: 150px;" class="text-end">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0; ?>
                                @foreach($items as $item)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ $item->variant }}</td>
                                    <td class="text-center">{{ $item->qty }}</td>
                                    <td class="text-end">₹ {{ $item->price }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-2 order-info-box">
                                    <h5>₹ {{ $order->deliver_charge }}</h5>
                                    <p>Delivery Charge</p>
                                </div>
                                <div class="col-md-2 order-info-box">
                                    <h5>₹ {{ $order->extra_charge }}</h5>
                                    <p>Extra Charge</p>
                                </div>
                                <div class="col-md-2 order-info-box">
                                    <h5>₹ {{ $order->total_amount }}</h5>
                                    <p>Total Amount</p>
                                </div>
                                <div class="col-md-2 order-info-box">
                                    <h5>₹ {{ $order->paid_amount }}</h5>
                                    <p>Paid Amount</p>
                                </div>
                                <div class="col-md-2 order-info-box">
                                    <h5>₹ {{ $order->pending_amount }}</h5>
                                    <p>Pending Amount</p>
                                </div>
                            </div>
                            <div class="mt-3 text-center">
                                <button class="col-md-2 btn-custom">Print Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection