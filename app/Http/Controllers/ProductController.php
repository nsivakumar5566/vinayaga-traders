<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    // Product Functions
    public function products()
    {
        $products = Product::latest()->paginate(20);

        return view('products.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function productcreate()
    {
        return view('products.create');
    }

    public function productstore(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $product = Product::create($request->all());

        return $this->productshow($product->id);
    }

    public function productshow($product_id)
    {
        $product = Product::find($product_id);
        $variants = Variant::where('product_id', $product->id)->latest()->paginate(20);
        return view('products.show', compact('product', 'variants'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function productedit($product_id)
    {
        $product = Product::find($product_id);
        return view('products.edit', compact('product'));
    }

    public function productupdate(Request $request, $product_id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $product = Product::find($product_id);
        $product->update($request->all());

        return $this->productshow($product->id);
    }

    public function productdelete($product_id)
    {
        $variants = Variant::where('product_id', $product_id)->get();
        foreach ($variants as $variant) {
            $variant->delete();
        }
        $product = Product::find($product_id);
        $product->delete();

        return $this->products();
    }

    // Variant Functions

    public function variantcreate($product_id)
    {
        return view('variants.create', compact('product_id'));
    }

    public function variantstore(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'variant' => 'required',
            'price' => 'required',
        ]);

        Variant::create($request->all());

        return $this->productshow($request->product_id);
    }

    public function variantshow($variant_id, $product_id)
    {
        $variant = Variant::find($variant_id);
        return view('variants.show', compact('variant', 'product_id'));
    }

    public function variantedit($variant_id)
    {
        $variant = Variant::find($variant_id);
        return view('variants.edit', compact('variant'));
    }

    public function variantupdate(Request $request, $variant_id)
    {
        $request->validate([
            'product_id' => 'required',
            'variant' => 'required',
            'price' => 'required',
        ]);

        $variant = Variant::find($variant_id);
        $variant->update($request->all());
        return $this->productshow($request->product_id);
    }

    public function variantdelete($variant_id, $product_id)
    {
        $variant = Variant::find($variant_id);
        $variant->delete();
        return $this->productshow($product_id);
    }

    public function getVariant($product_id)
    {
        $variants = Variant::where('product_id', $product_id)->get();
        $vardata = "<option value='' selected>Please Select Variant</option>";
        foreach ($variants as $variant) {
            $vardata .= "<option value=$variant->id data-price=$variant->price>$variant->variant</option>";
        }
        return $vardata;
    }
}
