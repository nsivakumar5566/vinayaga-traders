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
                <li class="breadcrumb-item">Variants</li>
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
                            <h5 class="card-title">Variant details :)</h5>
                            <div class="align-self-center">
                                <a href="{{ url('variant/edit', $variant->id) }}" class="btn-custom">Edit</a>
                                <button id="delete-record" type="button" class="btn-custom" data-bs-toggle="modal"
                                    data-bs-target="#verticalycentered"
                                    data-id="{{ url('variant/delete', [$variant->id, $product_id]) }}">
                                    Delete
                                </button>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="variant" class="form-label">Variant <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="variant" name="variant"
                                    value="{{ $variant->variant }}" disabled>
                            </div>
                            <div class="col-md-4">
                                <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="price" name="price"
                                    value="{{ $variant->price }}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection