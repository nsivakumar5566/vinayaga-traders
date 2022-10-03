@extends('layouts.app')
@section('title', 'Customers')
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
                        <li class="breadcrumb-item active">Customers</li>
                    </ol>
                </nav>
            </div>
            <div class="align-self-center">
                <a href="{{ route('customers.create') }}" type="button" class="btn-custom"><i
                        class="bi bi-clipboard-plus me-1"></i> Add
                    Customer</a>
            </div>
        </div>
    </div> <!-- breadcrumb ends -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">Customers ({{ count($customers) }})</h5>
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
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">City</th>
                                    <th scope="col">Pincode</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $customer)
                                <tr>
                                    <th scope="row">{{ ++$i }}</th>
                                    <td><a href="{{ route('customers.show', $customer->id) }}" class="text-black">{{
                                            $customer->name }}</a></td>
                                    <td><a href="{{ route('customers.show', $customer->id) }}" class="text-black">{{
                                            $customer->email }}</a></td>
                                    <td><a href="{{ route('customers.show', $customer->id) }}" class="text-black">{{
                                            $customer->mobile }}</a></td>
                                    <td><a href="{{ route('customers.show', $customer->id) }}" class="text-black">{{
                                            $customer->city }}</a></td>
                                    <td><a href="{{ route('customers.show', $customer->id) }}" class="text-black">{{
                                            $customer->pincode }}</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $customers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection