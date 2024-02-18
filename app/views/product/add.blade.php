@extends('layout.main')

@section('content')
<h1 class="text-center">Them san pham moi</h1>
    <a href="{{BASE_URL}}/list-product" class="btn btn-info">Quay lai <i class="fa fa-angle-left"></i></a>
    <hr/>
    @if(!empty($msg))
    <div class="alert alert-{{$msg_type}}">
        {{$msg}}
    </div>
    @endif
    <form method="POST" action="{{BASE_URL}}/post-product" enctype="multipart/form-data" class="mb-3">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>Tiêu đề san pham</label>
                    <input type="text" placeholder="Tiêu đề san pham...." class="form-control" name="title" value="{{old('title', $old)}}"/>
                    <p style="color: red">{{form_error('title', $errors)}}</p>
                </div>

                <div class="form-group">
                    <label>Mo ta</label>
                   <textarea class="form-control" placeholder="Mo ta san pham..." name="description">{{old('description', $old)}}</textarea>
                   <p style="color: red">{{form_error('description', $errors)}}</p>
                </div>

                <div class="form-group">
                    <label>Gia san pham</label>
                    <input type="text" placeholder="Gia san pham...." class="form-control" name="price" value="{{old('price', $old)}}"/>
                    <p style="color: red">{{form_error('price', $errors) }}</p>
                </div>

                <div class="form-group">
                    <label>Loại sản phẩm</label>
                    <select name="cate_id" class="form-control">
                        @if(!empty($allCate))
                            @foreach ($allCate as $item)
                                <option value="{{$item->id}}" {{old('cate_id',$old) == $item->id ? 'selected': false}}>{{$item->title}}</option>
                            @endforeach
                        @endif
                    </select>
                    <p style="color: red">{{form_error('cate_id', $errors) }}</p>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label>So luong</label>
                    <input type="text" placeholder="So luong...." class="form-control" name="quantity" value="{{old('quantity', $old)}}"/>
                    <p style="color: red">{{form_error('quantity', $errors)}}</p>
                </div>

                <div class="form-group">
                    <label>Noi dung san pham</label>
                    <textarea class="form-control" placeholder="Noi dung san pham..." name="content">{{old('content', $old)}}</textarea>
                    <p style="color: red">{{form_error('content', $errors)}}</p>
                </div>

                <div class="form-group">
                    <label>Anh MH</label>
                    <input type="file" class="form-control" name="thumbnail"/>
                    <p style="color: red">{{form_error('thumbnail', $errors)}}</p>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Thêm mới</button>
    </form>
@endsection