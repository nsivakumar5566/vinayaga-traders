@extends('layouts.app')
@section('title', 'Orders')
@section('content')

<main id="main" class="main">
    <!-- breadcrumb starts -->
    <div class="pagetitle">
        <div class="d-flex justify-content-between">
            <div>
                <h1>Dashboard</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Orders</li>
                    </ol>
                </nav>
            </div>
            <div class="align-self-center">
                <a href="{{ route('orders.create') }}" type="button" class="btn-custom"><i
                        class="bi bi-clipboard-plus me-1"></i> Create
                    Order</a>
            </div>
        </div>
    </div> <!-- breadcrumb ends -->

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
                                    style="background:#af9b95" @endif>
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