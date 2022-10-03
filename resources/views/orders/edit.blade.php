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
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div> <!-- breadcrumb ends -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Please fill the orders details :)</h5>
                        <form action="{{ route('orders.update', $order->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="customer" class="form-label">Customer</label>
                                    <select id="customer" class="js-select form-select" name="customer_id">
                                        <option selected readonly>Choose customer</option>
                                        @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}" {{ $order->customer_id == $customer->id ?
                                            'selected' : ''}}>{{ $customer->name }} - {{ $customer->mobile
                                            }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('customer_id'))
                                    <div class="mt-2" style="color:#620912">
                                        {{ $errors->first('customer_id') }}
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <label for="order-date" class="form-label">Order Date</label>
                                    <input type="datetime-local" class="form-control" id="order-date" name="order_date">
                                    @if($errors->has('order_date'))
                                    <div class="mt-2" style="color:#620912">
                                        {{ $errors->first('order_date') }}
                                    </div>
                                    @endif
                                </div>
                                <hr>
                            </div>
                            <!-- product select starts -->
                            @foreach($items as $item)
                            <div class="multipleQueue">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label for="product" class="form-label">Product</label>
                                        <select id="product" class="productdrop form-select" name="product_id[]">
                                            <option value="" selected readonly>Choose Your Product</option>
                                            @foreach($products as $product)
                                            <option value="{{ $product->id }}" {{ $item->product_id == $product->id ?
                                                'selected' : '' }}>{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('product_id'))
                                        <div class="mt-2" style="color:#620912">
                                            {{ $errors->first('product_id') }}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label for="variant" class="form-label">Variant</label>
                                        <select id="variant" class="variantdrop form-select" name="variant_id[]">
                                            @foreach($variants as $variant)
                                            <option value="{{ $variant->id }}" data-price="{{ $variant->price }}" {{
                                                $item->variant_id == $variant->id ?
                                                'selected' : '' }}>{{ $variant->variant }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('variant_id'))
                                        <div class="mt-2" style="color:#620912">
                                            {{ $errors->first('variant_id') }}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-md-1">
                                        <label for="qty" class="form-label">Quantity</label>
                                        <input type="number" class="variant-qty form-control" id="qty"
                                            value="{{ $item->qty }}" name="qty[]">
                                        @if($errors->has('qty'))
                                        <div class="mt-2" style="color:#620912">
                                            {{ $errors->first('qty') }}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="number" class="variant-price form-control" id="price"
                                            value="{{ $item->price }}" readonly name="price[]">
                                        @if($errors->has('price'))
                                        <div class="mt-2" style="color:#620912">
                                            {{ $errors->first('price') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div> <!-- product select ends -->
                            @endforeach

                            <!-- multiple inputs will generate starts -->
                            <div id="product-q">
                            </div> <!-- multiple inputs will generate ends -->

                            <div class="row g-3 mt-4 justify-content-center">
                                <div class="col-3 text-center">
                                    <a role="button" id="add-q"><i class="bi bi-plus-circle-fill"></i> Add
                                        Product</a>
                                </div>
                                <hr>
                            </div>
                            <div class="row g-3 mt-3">
                                <div class="col-md-3">
                                    <label for="deliver-charge" class="form-label">Deliver Charge</label>
                                    <input type="number" class="form-control" id="deliver-charge" name="deliver_charge"
                                        value="{{ $order->deliver_charge }}">
                                    @if($errors->has('deliver_charge'))
                                    <div class="mt-2" style="color:#620912">
                                        {{ $errors->first('deliver_charge') }}
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <label for="extra-charge" class="form-label">Extra Charge</label>
                                    <input type="number" class="form-control" id="extra-charge" name="extra_charge"
                                        value="{{ $order->extra_charge }}">
                                    @if($errors->has('extra_charge'))
                                    <div class="mt-2" style="color:#620912">
                                        {{ $errors->first('extra_charge') }}
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <label for="fully-paid" class="form-label">Fully Paid</label>
                                    <select id="fully-paid" class="form-select" name="fully_paid">
                                        <option value="1" {{ $order->fully_paid == 1 ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ $order->fully_paid == 0 ? 'selected' : '' }}>No</option>
                                    </select>
                                    @if($errors->has('fully_paid'))
                                    <div class="mt-2" style="color:#620912">
                                        {{ $errors->first('fully_paid') }}
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-3" id="paid-column" @if($order->fully_paid == 1) style="display:
                                    none;" @endif>
                                    <label for="paid-amount" class="form-label">Paid Amount</label>
                                    <input type="number" class="form-control" id="paid-amount" name="paid_amount"
                                        value="{{ $order->paid_amount }}">
                                    @if($errors->has('paid_amount'))
                                    <div class="mt-2" style="color:#620912">
                                        {{ $errors->first('paid_amount') }}
                                    </div>
                                    @endif
                                </div>
                                <hr>
                            </div>
                            <div class="row g-3 mt-3 justify-content-center">
                                <div class="col-md-2">
                                    <input type="number" id="total-amount" class="form-control" name="total_amount"
                                        readonly value="{{ $order->total_amount }}">
                                    <h5 class="product-output">Total Charge</h5>
                                    @if($errors->has('total_amount'))
                                    <div class="mt-2" style="color:#620912">
                                        {{ $errors->first('total_amount') }}
                                    </div>
                                    @endif
                                </div>
                                <hr>
                                <div class="col-md-3 text-center">
                                    <button type="submit" class="btn-custom"><i class="bi bi-clipboard-plus me-1"></i>
                                        Update Order</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<div id="clone-q" style="display: none;">
    <div class='multipleQueue'>
        <div class='row g-3'>
            <div class='col-md-4'>
                <label for='product' class='form-label'>Product</label>
                <select id='product' class='productdrop form-select' name='product_id[]'>
                    <option value='' selected readonly>Choose Your Product</option>
                    @foreach($products as $product)
                    <option value='{{ $product->id }}'>{{ $product->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('product_id'))
                <div class="mt-2" style="color:#620912">
                    {{ $errors->first('product_id') }}
                </div>
                @endif
            </div>
            <div class='col-md-4'>
                <label for='variant' class='form-label'>Variant</label>
                <select id='variant' class='variantdrop form-select' name='variant_id[]'>
                    <option value='' selected readonly>Choose Your Variant</option>
                </select>
                @if($errors->has('variant_id'))
                <div class="mt-2" style="color:#620912">
                    {{ $errors->first('variant_id') }}
                </div>
                @endif
            </div>
            <div class='col-md-1'>
                <label for='qty' class='form-label'>Quantity</label>
                <input type='number' class='variant-qty form-control' id='qty' value='1' name='qty[]'>
                @if($errors->has('qty'))
                <div class="mt-2" style="color:#620912">
                    {{ $errors->first('qty') }}
                </div>
                @endif
            </div>
            <div class='col-md-3'>
                <label for='price' class='form-label'>Price</label>
                <input type='number' class='variant-price form-control' id='price' value='' readonly name='price[]'>
                @if($errors->has('price'))
                <div class="mt-2" style="color:#620912">
                    {{ $errors->first('price') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection