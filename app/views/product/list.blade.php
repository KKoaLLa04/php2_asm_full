@extends('layout.main')

@section('content')
    <h1 class="text-center">Danh sách sản phẩm</h1>
    <a href="{{BASE_URL}}/add-product" class="btn btn-success">Them moi <i class="fa fa-plus"></i></a>
    @if(!empty($msg))
        <div class="alert alert-{{$msg_type}}">{{$msg}}</div>
    @endif
    <hr/>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Tiêu đề</th>
                <th>Gía</th>
                <th>Số lượng</th>
                <th>Nội dung</th>
                <th>Loại sản phẩm</th>
                <th width="5%">Sửa</th>
                <th width="5%">Xóa</th>
            </tr>
        </thead>

        <tbody>
            @if(!empty($data))
                @foreach($data as $key => $item)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$item->title}}</td>
                <td>{{$item->price}}</td>
                <td>{{$item->quantity}}</td>
                <td>{{$item->content}}</td>
                <td>{{$item->cate_title}}</td>
                <td><a href="{{BASE_URL.'/edit-product/'.$item->id}}" class="btn btn-warning"><i class="fa fa-edit"></i></a></td>
                <td><a href="{{BASE_URL.'/delete-product/'.$item->id}}" class="btn btn-danger" onclick="return confirm('are you sure?')"><i class="fa fa-trash"></i></a></td>
            </tr>
                @endforeach 
            @endif
        </tbody>
    </table>
@endsection