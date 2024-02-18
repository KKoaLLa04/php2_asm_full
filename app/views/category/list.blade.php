@extends('layout.main')

@section('content')
    <h1 class="text-center">Danh mục sản phẩm</h1>
    <a href="{{BASE_URL}}add-cate" class="btn btn-success">Them moi <i class="fa fa-plus"></i></a>
    @if(!empty($msg))
        <div class="alert alert-{{$msg_type}}">{{$msg}}</div>
    @endif
    <hr/>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th width="3%">#</th>
                <th>Tiêu đề</th>
                <th>Ngày tạo</th>
                <th width="5%">Sửa</th>
                <th width="5%">Xóa</th>
            </tr>
        </thead>

        <tbody>
            @if(!empty($listCate))
                @foreach($listCate as $key => $item)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$item->title}}</td>
                <td>{{$item->created_at}}</td>
                <td><a href="{{BASE_URL.'/edit-cate/'.$item->id}}" class="btn btn-warning"><i class="fa fa-edit"></i></a></td>
                <td><a href="{{BASE_URL.'/delete-cate/'.$item->id}}" class="btn btn-danger" onclick="return confirm('are you sure?')"><i class="fa fa-trash"></i></a></td>
            </tr>
                @endforeach 
            @endif
        </tbody>
    </table>
@endsection