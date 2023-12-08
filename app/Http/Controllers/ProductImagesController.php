<?php

namespace App\Http\Controllers;

use App\Models\ProductImages;
use Illuminate\Http\Request;

class ProductImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 獲取上傳的檔案
        $uploadedFile = $request->file('image');

        // 儲存圖片（到本地或雲端）
        $path = $uploadedFile->store('product_images', 'public'); // 儲存到 storage/app/public/product_images 目錄中

        // 將路徑添加到 $validated 數組中
        $validated['path'] = $path;

        // 在當前使用者的上下文中創建產品
        // $product = $request->user()->products()->create($request->only(['name', 'price', 'inventory','description']));

        $product = ProductImagesController::create($validated);

        // 創建與產品關聯的圖片記錄
        // $product->images()->create($validated);

        return response()->json(['message' => 'Product image uploaded successfully'], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(ProductImages $productImages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductImages $productImages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductImages $productImages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductImages $productImages)
    {
        //
    }
}
