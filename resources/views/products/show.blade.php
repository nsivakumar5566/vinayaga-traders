@extends('layouts.app')
@section('title', 'Products')
@section('content')

<main id="main" class="main">
    <!-- breadcrumb starts -->
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('products') }}">Products</a></li>
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
                            <h5 class="card-title">Products Detail</h5>
                            <div class="align-self-center">
                                <a href="{{ url('product/edit', $product->id) }}" class="btn-custom">Edit</a>
                                <button id="delete-record" type="button" class="btn-custom" data-bs-toggle="modal"
                                    data-bs-target="#verticalycentered"
                                    data-id="{{ url('product/delete', $product->id) }}">
                                    Delete
                                </button>
                            </div>
                        </div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $product->name }}</td>
                                </tr>
                            </tbody>
                        </table>
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
                            <h5 class="card-title">Variants ({{ count($variants) }})</h5>
                            <div class="align-self-center">
                                <a href="{{ url('variant/create', $product->id) }}" type="button" class="btn-custom"><i
                                        class="bi bi-clipboard-plus me-1"></i> Add
                                    Variant</a>
                            </div>
                        </div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 50px;">#</th>
                                    <th scope="col">Variant</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($variants as $variant)
                                <tr>
                                    <td><a href="{{ url('variant/show', [$variant->id, $product->id]) }}"
                                            class="text-black">{{ ++$i
                                            }}</a></td>
                                    <td><a href="{{ url('variant/show', [$variant->id, $product->id]) }}"
                                            class="text-black">{{
                                            $variant->variant }}</a></td>
                                    <td><a href="{{ url('variant/show', [$variant->id, $product->id]) }}"
                                            class="text-black">₹ {{
                                            $variant->price }}</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $variants->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection