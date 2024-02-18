@extends('layout.main')

@section('content')
<h1 class="text-center">Cap nhat san pham moi</h1>
    <a href="{{BASE_URL}}/list-product" class="btn btn-info">Quay lai <i class="fa fa-angle-left"></i></a>
    <hr/>
    @if(!empty($msg))
    <div class="alert alert-{{$msg_type}}">
        {{$msg}}
    </div>
    @endif
    <form method="POST" action="{{BASE_URL}}/edit-post/{{$productDetail->id}}" enctype="multipart/form-data" class="mb-3">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>Tiêu đề san pham</label>
                    <input type="text" placeholder="Tiêu đề san pham...." class="form-control" name="title" value="{{$productDetail->title ?? old('title', $old)}}"/>
                    <p style="color: red">{{form_error('title', $errors)}}</p>
                </div>

                <div class="form-group">
                    <label>Mo ta</label>
                   <textarea class="form-control" placeholder="Mo ta san pham..." name="description">{{$productDetail->description ?? old('description', $old)}}</textarea>
                   <p style="color: red">{{form_error('description', $errors)}}</p>
                </div>

                <div class="form-group">
                    <label>Gia san pham</label>
                    <input type="text" placeholder="Gia san pham...." class="form-control" name="price" value="{{$productDetail->price ?? old('price', $old)}}"/>
                    <p style="color: red">{{form_error('price', $errors) }}</p>
                </div>

                <div class="form-group">
                    <label>Loại sản phẩm</label>
                    <select name="cate_id" class="form-control">
                        @if(!empty($allCate))
                            @foreach ($allCate as $item)
                                <option value="{{$item->id}}" {{old('cate_id',$old) == $item->id || $productDetail->cate_id == $item->id ? 'selected': false}}>{{$item->title}}</option>
                            @endforeach
                        @endif
                    </select>
                    <p style="color: red">{{form_error('cate_id', $errors) }}</p>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label>So luong</label>
                    <input type="text" placeholder="So luong...." class="form-control" name="quantity" value="{{$productDetail->quantity ?? old('quantity', $old)}}"/>
                    <p style="color: red">{{form_error('quantity', $errors)}}</p>
                </div>

                <div class="form-group">
                    <label>Noi dung san pham</label>
                    <textarea class="form-control" placeholder="Noi dung san pham..." name="content">{{$productDetail->content ?? old('content', $old)}}</textarea>
                    <p style="color: red">{{form_error('content', $errors)}}</p>
                </div>

                <div class="form-group">
                    <label>Anh MH</label>
                    <div class="row">
                        <div class="col-6">
                            <input type="file" class="form-control" name="thumbnail"/>
                        </div>
                        <div class="col-6">
                            <img src="{{BASE_URL.'/public/uploads/'.$productDetail->thumbnail}}" alt="image" width="100%">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Cap nhat</button>
    </form>
@endsection