<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads; // 導入WithFileUploads 使圖片上傳功能正常

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; // 自動生成編號

class ProductManager extends Component
{
    use WithFileUploads;

    public $number;
    public $image;
    public $name;
    public $price;
    public $stock;

    public function render()
    {
        $products = Product::all();
        return view('livewire.product-manager', compact('products'));
    }

    public function createProduct()
    {
        // 自動生成編號
        $number = Str::uuid();

        //定義表單驗證規則
        $this->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'image|max:1024'
        ]);

        $imagePath = null;

        if ($this->image) {
            $imagePath = $this->image->store('products', 'public');
        }
        try {
            Product::create([
                'name' => $this->name,
                'price' => $this->price,
                'stock' => $this->stock,
                'number' => $number,
                'image_path' => $imagePath,
            ]);

            // 成功訊息
            session()->flash('success', '商品新增成功');
        } catch (\Exception $e) {
            // 失敗訊息
            session()->flash('error', '商品新增失敗');
        }

        $this->reset(); // 清空輸入欄位
    }
    public function deleteProduct($productId)
    {
        $product = Product::find($productId);

        if ($product) {
            // 删除商品图片（如果存在）
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }

            // 删除商品记录
            $product->delete();

            // 成功訊息
            session()->flash('success', '商品删除成功');
        } else {
            // 失敗訊息
            session()->flash('error', '商品删除失败');
        }
    }
}
