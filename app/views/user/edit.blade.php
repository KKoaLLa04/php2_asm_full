@extends('layout.main')

@section('content')
<h1 class="text-center">Cập nhật người dùng</h1>
    <a href="{{BASE_URL}}/list-user" class="btn btn-info">Quay lai <i class="fa fa-angle-left"></i></a>
    <hr/>
    @if(!empty($msg))
    <div class="alert alert-{{$msg_type}}">
        {{$msg}}
    </div>
    @endif
    <form method="POST" action="{{BASE_URL}}/edit-postuser/{{$userDetail->id}}" enctype="multipart/form-data" class="mb-3">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>Họ và tên</label>
                    <input type="text" placeholder="Họ và tên...." class="form-control" name="fullname" value="{{$userDetail->fullname ?? old('fullname', $old)}}"/>
                    <p style="color: red">{{form_error('fullname', $errors)}}</p>
                </div>

                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="text" placeholder="số điện thoại...." class="form-control" name="phone" value="{{$userDetail->phone ?? old('phone', $old)}}"/>
                   <p style="color: red">{{form_error('phone', $errors)}}</p>
                </div>

                <div class="form-group">
                    <label>email</label>
                    <input type="text" placeholder="email...." class="form-control" name="email" value="{{$userDetail->email ?? old('email', $old)}}"/>
                    <p style="color: red">{{form_error('email', $errors) }}</p>
                </div>

            </div>

            <div class="col-6">
                <div class="form-group">
                    <label>Mật khẩu</label>
                    <input type="password" placeholder="Mật khẩu...." class="form-control" name="password"/>
                    <p style="color: red">{{form_error('password', $errors)}}</p>
                </div>

                <div class="form-group">
                    <label>Xác nhận mật khẩu</label>
                    <input type="password" placeholder="Xác nhận mật khẩu...." class="form-control" name="confirm_password"/>
                    <p style="color: red">{{form_error('confirm_password', $errors)}}</p>
                </div>
                <div class="form-group">
                    <label>Trạng thái</label>
                    <select name="status" class="form-control">
                        <option value="0" {{$userDetail->status==0?'selected':false}}>Không kích hoạt</option>
                        <option value="1" {{$userDetail->status==1?'selected':false}}>Kích hoạt</option>
                    </select>
                    <p style="color: red">{{form_error('status', $errors)}}</p>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
@endsection