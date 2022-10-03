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
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div> <!-- breadcrumb ends -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Please fill the customer details :)</h5>
                        <form class="row g-3" method="post" action="{{ route('customers.update', $customer->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="col-md-4">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $customer->name }}">
                                @if($errors->has('name'))
                                <div class="mt-2" style="color:#620912">
                                    {{ $errors->first('name') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <label for="mobile" class="form-label">Mobile Number <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="mobile" name="mobile"
                                    value="{{ $customer->mobile }}">
                                @if($errors->has('mobile'))
                                <div class="mt-2" style="color:#620912">
                                    {{ $errors->first('mobile') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ $customer->email }}">
                            </div>
                            <div class="col-md-4">
                                <label for="address-line1" class="form-label">Door No./Building Name</label>
                                <input type="text" class="form-control" id="address-line1" name="address_line1"
                                    value="{{ $customer->address_line1 }}">
                            </div>
                            <div class="col-md-4">
                                <label for="address-line2" class="form-label">Street/Village Name</label>
                                <input type="text" class="form-control" id="address-line2" name="address_line2"
                                    value="{{ $customer->address_line2 }}">
                            </div>
                            <div class="col-md-4">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" id="city" name="city"
                                    value="{{ $customer->city }}">
                            </div>
                            <div class="col-md-4">
                                <label for="state" class="form-label">State</label>
                                <input type="text" class="form-control" id="state" name="state"
                                    value="{{ $customer->state }}">
                            </div>
                            <div class="col-md-4">
                                <label for="pincode" class="form-label">Pincode</label>
                                <input type="text" class="form-control" id="pincode" name="pincode"
                                    value="{{ $customer->pincode }}">
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn-custom"><i class="bi bi-clipboard-plus me-1"></i>
                                    Update Customer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection