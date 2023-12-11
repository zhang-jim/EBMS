<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
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
    public function store(Request $request, $product_id)
    {
        // 數據驗證
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 確保商品存在
        $product = Product::find($product_id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // 獲取上傳的檔案
        $uploadedFile = $request->file('image');

        // 儲存圖片（到本地或雲端）
        $path = $uploadedFile->store('product_images', 'public'); // 儲存到 storage/app/public/product_images 目錄中

        // 將路徑添加到 $validated 數組中
        $validated['path'] = $path;

        // 將資料庫新增的動作移至 Product 模型的 productImages 關聯
        $product->productImages()->create($validated);

        return response()->json(['message' => 'Product image uploaded successfully'], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(ProductImage $productImages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductImage $productImages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductImage $productImage)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductImage $productImages)
    {
        //
    }
}
