<div>
    <style>
        /* Your CSS Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
    <form wire:submit.prevent="createProduct">
        <input wire:model="name" type="text" placeholder="商品名稱">
        <input wire:model="price" type="text" placeholder="價格">
        <input wire:model="stock" type="text" placeholder="庫存">
        <input wire:model="image" type="file" accept="image/*">
        <button type="submit">新增商品</button>
    </form>

    <!-- 商品列表 -->
    <table>
        <!-- Table Header -->
        <thead>
            <tr>
                <th>編號</th>
                <th>商品名稱</th>
                <th>價格</th>
                <th>庫存</th>
                <th>圖片</th>
                <th>功能</th>
            </tr>
        </thead>
        <!-- Table Body -->
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->number }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td><img src="{{ asset('storage/' . $product->image_path) }}" alt="Product Image" style="max-width: 100px;"></td>
                    <td>
                        <button wire:click="showProduct({{ $product->id }})">檢視</button>
                        <button wire:click="editProduct({{ $product->id }})">編輯</button>
                        <button wire:click="deleteProduct({{ $product->id }})">刪除</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
