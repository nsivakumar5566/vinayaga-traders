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
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div> <!-- breadcrumb ends -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Please fill the variants details :)</h5>
                        <form class="row g-3" action="{{ url('variant/update', $variant->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="text" name="product_id" value="{{ $variant->product_id }}" hidden>
                            <div class="col-md-4">
                                <label for="variant" class="form-label">Variant <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="variant" name="variant"
                                    value="{{ $variant->variant }}">
                                @if($errors->has('variant'))
                                <div class="mt-2" style="color:#620912">
                                    {{ $errors->first('variant') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="price" name="price"
                                    value="{{ $variant->price }}">
                                @if($errors->has('price'))
                                <div class="mt-2" style="color:#620912">
                                    {{ $errors->first('price') }}
                                </div>
                                @endif
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn-custom"><i class="bi bi-clipboard-plus me-1"></i>
                                    Update Variant</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection