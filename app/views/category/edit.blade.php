@extends('layout.main')

@section('content')
<h1 class="text-center">Cap nhat danh muc san pham</h1>
    <a href="{{BASE_URL}}list-cate" class="btn btn-info">Quay lai <i class="fa fa-angle-left"></i></a>
    <hr/>
    @if(!empty($msg))
    <div class="alert alert-{{$msg_type}}">
        {{$msg}}
    </div>
    @endif
    <form method="POST" action="{{BASE_URL}}/edit-cate/{{$cateDetail->id}}" enctype="multipart/form-data" class="mb-3">
        <div class="form-group">
            <label>Tiêu đề danh muc san pham</label>
            <input type="text" placeholder="Tiêu đề san pham...." class="form-control" name="title" value="{{$cateDetail->title ?? old('title', $old)}}"/>
            <p style="color: red">{{form_error('title', $errors)}}</p>
        </div>
        <button type="submit" class="btn btn-primary">Cap nhat</button>
    </form>
@endsection