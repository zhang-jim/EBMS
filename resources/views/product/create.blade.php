@extends('layouts.app') <!-- 使用主布局 -->

@section('content')
    <div class="row">
        <div class="col-md-12">

            @if (session('status'))
                <h6> {{ session('status') }} </h6>
            @endif

            <div class="card">
                <div class="card-header">
                    <h1>Add Product
                        <a href=" {{ url('product') }} ">back</a>
                    </h1>
                </div>
                <div class="card-body">
                    <form action=" {{ url('product/create') }} " method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="">name</label>
                            <input type="text" name="name">
                        </div>
                        <div>
                            <label for="">description</label>
                            <input type="text" name="description">
                        </div>
                        <div>
                            <label for="">price</label>
                            <input type="number" name="price">
                        </div>
                        <div>
                            <label for="">inventory</label>
                            <input type="number" name="inventory">
                        </div>
                        <div>
                            <label for="">image</label>
                            <input type="file" name="image">
                        </div>
                        <div>
                            <button type="submit">save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- name	description	price	inventory	image --}}
