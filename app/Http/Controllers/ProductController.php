<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\ProductImagesController;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    protected $productImagesController;
    public function __construct(ProductImagesController $productImagesController)
    {
        $this->productImagesController = $productImagesController;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        // 將資料傳遞到前端（使用 Vue.js 3）
        return Inertia::render('Product/Index', [
            'productData' => Product::with('productImages')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 數據驗證
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'inventory' => 'required|integer',
            'description' => 'nullable|string|max:1000',
        ]);

        $product = Product::create($request->only(['name', 'price', 'inventory', 'description']));

        // 重定向到產品管理頁
        // return redirect(route('product.index'));
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $this->authorize('update', $product);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'inventory' => 'required|integer',
            'description' => 'nullable|string|max:1000',
        ]);

        $product->update($validated);

        return redirect(route('product.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $this->authorize('delete', $product);

        $product->delete();

        return redirect(route('product.index'));
    }
}
