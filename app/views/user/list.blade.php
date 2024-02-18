@extends('layout.main')

@section('content')
    <h1 class="text-center">Danh sách Nguoi dung</h1>
    <a href="{{BASE_URL}}/add-user" class="btn btn-success">Them moi <i class="fa fa-plus"></i></a>
    @if(!empty($msg))
        <div class="alert alert-{{$msg_type}}">{{$msg}}</div>
    @endif
    <hr/>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Họ và tên</th>
                <th>SDT</th>
                <th>Email</th>
                <th width="12%">tình trạng</th>
                <th width="5%">Sửa</th>
                {{-- <th width="5%">Xóa</th> --}}
            </tr>
        </thead>

        <tbody>
            @if(!empty($data))
                @foreach($data as $key => $item)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$item->fullname}}</td>
                        <td>{{$item->phone}}</td>
                        <td>{{$item->email}}</td>
                        <td class="text-center">
                            @if($item->status==0)
                                <button class="btn btn-danger">Khóa</button>
                            @else 
                                <button class="btn btn-success">Kích Hoạt</button>
                            @endif
                        </td>
                        <td><a href="{{BASE_URL.'/edit-user/'.$item->id}}" class="btn btn-warning"><i class="fa fa-edit"></i></a></td>
                        {{-- <td><a href="{{BASE_URL.'/delete-user/'.$item->id}}" class="btn btn-danger" onclick="return confirm('are you sure?')"><i class="fa fa-trash"></i></a></td> --}}
                    </tr>
                @endforeach 
            @endif
        </tbody>
    </table>
@endsection