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
                <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">Customers</a></li>
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
                            <h5 class="card-title">Customer details :)</h5>
                            <div class="align-self-center">
                                <a href="{{ route('customers.edit', $customer->id) }}" class="btn-custom">Edit</a>
                                <button id="delete-record" type="button" class="btn-custom" data-bs-toggle="modal"
                                    data-bs-target="#verticalycentered"
                                    data-id="{{ route('customers.destroy', $customer->id) }}">
                                    Delete
                                </button>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" value="{{ $customer->name }}"
                                    disabled>
                            </div>
                            <div class="col-md-4">
                                <label for="mobile" class="form-label">Mobile Number <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="mobile" value="{{ $customer->mobile }}"
                                    disabled>
                            </div>
                            <div class="col-md-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" value="{{ $customer->email }}"
                                    disabled>
                            </div>
                            <div class="col-md-4">
                                <label for="address-line1" class="form-label">Door No./Building Name</label>
                                <input type="text" class="form-control" id="address-line1"
                                    value="{{ $customer->address_line1 }}" disabled>
                            </div>
                            <div class="col-md-4">
                                <label for="address-line2" class="form-label">Street/Village Name</label>
                                <input type="text" class="form-control" id="address-line2"
                                    value="{{ $customer->address_line2 }}" disabled>
                            </div>
                            <div class="col-md-4">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" id="city" value="{{ $customer->city }}"
                                    disabled>
                            </div>
                            <div class="col-md-4">
                                <label for="state" class="form-label">State</label>
                                <input type="text" class="form-control" id="state" value="{{ $customer->state }}"
                                    disabled>
                            </div>
                            <div class="col-md-4">
                                <label for="pincode" class="form-label">Pincode</label>
                                <input type="text" class="form-control" id="pincode" value="{{ $customer->pincode }}"
                                    disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">Orders ({{ count($orders) }})</h5>
                            <div class="index-search-bar align-self-center">
                                <form class="search-form d-flex align-items-center" method="POST" action="#">
                                    <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                                    <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 50px;">#</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col" class="text-center">Order Date</th>
                                    <th scope="col" class="text-center">Delivery Charge</th>
                                    <th scope="col" class="text-center">Extra Charge</th>
                                    <th scope="col" class="text-center">Total Amount</th>
                                    <th scope="col" class="text-center">Paid Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr @if($order->total_amount != $order->paid_amount)
                                    style="color:red" @endif>
                                    <th scope="row"><a href="{{ route('orders.show', $order->id) }}"
                                            class="text-black">{{ ++$i }}</a></th>
                                    <td><a href="{{ route('orders.show', $order->id) }}" class="text-black">{{
                                            $order->Customer->name }}</a></td>
                                    <td class="text-center"><a href="{{ route('orders.show', $order->id) }}"
                                            class="text-black">{{ $order->order_date }}</a></td>
                                    <td class="text-center"><a href="{{ route('orders.show', $order->id) }}"
                                            class="text-black">₹ {{ $order->deliver_charge }}</a></td>
                                    <td class="text-center"><a href="{{ route('orders.show', $order->id) }}"
                                            class="text-black">₹ {{ $order->extra_charge }}</a></td>
                                    <td class="text-center"><a href="{{ route('orders.show', $order->id) }}"
                                            class="text-black">₹ {{ $order->total_amount }}</a></td>
                                    <td class="text-center"><a href="{{ route('orders.show', $order->id) }}"
                                            class="text-black">₹ {{ $order->paid_amount }}</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection