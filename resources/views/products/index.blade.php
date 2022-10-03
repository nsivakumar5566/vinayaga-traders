@extends('layouts.app')
@section('title', 'Products')
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
                        <li class="breadcrumb-item active">Products</li>
                    </ol>
                </nav>
            </div>
            <div class="align-self-center">
                <a href="{{ url('product/create') }}" type="button" class="btn-custom"><i
                        class="bi bi-clipboard-plus me-1"></i> Add
                    Product</a>
            </div>
        </div>
    </div> <!-- breadcrumb ends -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">Products ({{ count($products) }})</h5>
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <th scope="row"><a href="{{ url('product/show', $product->id) }}"
                                            class="text-black">{{ ++$i }}</a>
                                    </th>
                                    <td><a href="{{ url('product/show', $product->id) }}" class="text-black">{{
                                            $product->name }}</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection