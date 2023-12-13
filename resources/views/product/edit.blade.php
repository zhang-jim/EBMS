@extends('layouts.app') <!-- 使用主布局 -->

@section('content')
    <div class="row">
        <div class="col-md-12">

            @if (session('status'))
                <h6> {{ session('status') }} </h6>
            @endif

            <div class="card">
                <div class="card-header">
                    <h1>Edit Product
                        <a href=" {{ url('product') }} ">back</a>
                    </h1>
                </div>
                <div class="card-body">
                    <form action=" {{ url('product',$product) }} " method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="">name</label>
                            <input value="{{$product->name}}" type="text" name="name">
                        </div>
                        <div>
                            <label for="">description</label>
                            <input value="{{$product->description}}" type="text" name="description">
                        </div>
                        <div>
                            <label for="">price</label>
                            <input value="{{$product->price}}" type="number" name="price">
                        </div>
                        <div>
                            <label for="">inventory</label>
                            <input value="{{$product->inventory}}" type="number" name="inventory">
                        </div>
                        <div>
                            <label for="">image</label>
                            <input type="file" name="image">
                            <img src="{{ asset('storage/product_images/'.$product->image ) }}" alt="" width="70px" height="70px">
                        </div>
                        <div>
                            <button type="submit">update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- name	description	price	inventory	image --}}
