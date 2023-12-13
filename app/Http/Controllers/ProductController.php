<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    // 抓取所有商品資訊，回傳並導向商品列表頁
    public function index()
    {
        $product = Product::all();
        // 導向product/index.blade.php
        return view('product.index', compact('product'));
    }
    // 導向新增商品頁
    public function create()
    {
        return view('product.create');
    }

    // 新增商品功能，處理資料及資料庫交互
    public function store(Request $request)
    {
        $product = new Product;
        // 數據驗證
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->inventory = $request->input('inventory');

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('storage/product_images/', $filename);
            $product->image = $filename;
        }
        $product->save();
        // 回傳新增狀態(成功/失敗)
        return redirect()->back()->with('status', 'image added success');
    }
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,string $id)
    {
        $product = Product::find($id);

        // 數據驗證
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->inventory = $request->input('inventory');

        if ($request->hasfile('image')) {
            $destination = 'storage/product_images/' . $product->image;

            if (File::exists($destination)) {
                File::delete($destination);
            }

            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('storage/product_images/', $filename);
            $product->image = $filename;
        }
        $product->update();
        // $product->save();
        return redirect()->back()->with('status', '商品資訊更新成功');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 查找要刪除的商品
        $product = Product::find($id);

        $destination = 'storage/product_images/' . $product->image;
        File::delete($destination);
        $product->delete($id);

        // 重定向到產品管理頁
        return redirect('product');
    }
}
