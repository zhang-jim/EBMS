@extends('layouts.app') <!-- 使用主布局 -->

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Product List
                        <a href=" {{ url('product/create') }} ">Add product</a>
                    </h1>
                </div>
                <div class="card-body">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Inventory</th>
                                <th>Image</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->inventory }}</td>
                                    <td>
                                        <img src="{{ asset('storage/product_images/'.$item->image ) }}" alt="" width="70px" height="70px">
                                    </td>
                                    <td>
                                        <a href="{{ url('product/'.$item->id.'/edit') }}">Edit</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('product/'.$item->id) }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
