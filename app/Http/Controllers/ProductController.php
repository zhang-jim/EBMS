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
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //將商品列表關聯圖片一起抓出，回傳到前端
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
        // 新增商品資料
        $product = Product::create($validated);

        //將新增資訊傳遞給ProductImagesController進行圖片資料新增
        app(ProductImagesController::class)->store($request, $product->id);

        // 重定向到產品管理頁
        return redirect(route('product.index'));
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
        // 數據驗證
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'inventory' => 'required|integer',
            'description' => 'nullable|string|max:1000',
        ]);

        //更新商品資訊
        $product->update($validated);

        // 重定向到產品管理頁
        return redirect(route('product.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        // 使用授權（Policy）檢查使用者是否有權刪除該商品
        // $this->authorize('delete', $product);

        // 刪除商品
        $product->delete();

        // 重定向到產品管理頁
        return redirect(route('product.index'));
    }
}
