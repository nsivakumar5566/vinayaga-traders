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
                <li class="breadcrumb-item"><a href="{{ url('products') }}">Products</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div> <!-- breadcrumb ends -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Please fill the products details :)</h5>
                        <form class="row g-3" action="{{ url('product/update', $product->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="col-md-4">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $product->name }}">
                                @if($errors->has('name'))
                                <div class="mt-2" style="color:#620912">
                                    {{ $errors->first('name') }}
                                </div>
                                @endif
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn-custom"><i class="bi bi-clipboard-plus me-1"></i>
                                    Update Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection