<?php

namespace App\Controllers;

use App\Models\User;

class UserController extends BaseController
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index()
    {
        $data = $this->user->getAllUser();
        return $this->render('user.list', compact('data'));
    }

    public function addUser()
    {
        $msg = getFlashData('msg');
        $msg_type = getFlashData('msg_type');
        $errors = getFlashData('errors');
        $old = getFlashData('old');

        return $this->render('user.add', compact('msg', 'msg_type', 'errors', 'old'));
    }

    public function postUser()
    {
        $errors = [];

        if (empty(trim($_POST['fullname']))) {
            $errors['fullname'] = 'Họ và tên không được để trống!';
        }

        if (empty(trim($_POST['phone']))) {
            $errors['phone'] = 'Số điện thoại không được để trống';
        }

        if (empty(trim($_POST['email']))) {
            $errors['email'] = 'Email không được để trống';
        } else {
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email không đúng định dạng';
            } else {
                $checkEmail = $this->user->checkEmail($_POST['email']);

                if (!empty($checkEmail)) {
                    $errors['email'] = 'Email đã tồn tại!';
                }
            }
        }

        if (empty(trim($_POST['password']))) {
            $errors['password'] = 'Mat khau khong duoc de trong';
        }

        if (empty(trim($_POST['confirm_password']))) {
            $errors['confirm_password'] = 'Xac nhan mat khau khong duoc de trong';
        } else {
            if (trim($_POST['password']) != trim($_POST['confirm_password'])) {
                $errors['confirm_password'] = 'Xác nhận mật khẩu không trùng khớp';
            }
        }

        if (empty($errors)) {
            $fullname = $_POST['fullname'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $status = $_POST['status'];

            $this->user->addUser($fullname, $phone, $email, $password, $status);

            setFlashData('msg', 'Thêm người dùng thành công!');
            setFlashData('msg_type', 'success');
        } else {
            setFlashData('msg', 'Có lỗi xảy ra, vui lòng kiểm tra lại');
            setFlashData('msg_type', 'danger');
            setFlashData('errors', $errors);
            setFlashData('old', $_POST);
        }

        header("Location: " . BASE_URL . 'add-user');
    }

    public function editUser($id)
    {
        $msg = getFlashData('msg');
        $msg_type = getFlashData('msg_type');
        $errors = getFlashData('errors');
        $old = getFlashData('old');

        $userDetail = $this->user->getUserDetail($id);

        return $this->render('user.edit', compact('msg', 'msg_type', 'errors', 'old', 'userDetail'));
    }

    public function editPostUser($id)
    {
        $errors = [];

        if (empty(trim($_POST['fullname']))) {
            $errors['fullname'] = 'Họ và tên không được để trống!';
        }

        if (empty(trim($_POST['phone']))) {
            $errors['phone'] = 'Số điện thoại không được để trống';
        }

        if (empty(trim($_POST['email']))) {
            $errors['email'] = 'Email không được để trống';
        } else {
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email không đúng định dạng';
            } else {
                $checkEmail = $this->user->checkEmailUpdate($_POST['email'], $id);

                if (!empty($checkEmail)) {
                    $errors['email'] = 'Email đã tồn tại!';
                }
            }
        }

        if (!empty($_POST['password'])) {
            if (empty(trim($_POST['confirm_password']))) {
                $errors['confirm_password'] = 'Xac nhan mat khau khong duoc de trong';
            } else {
                if (trim($_POST['password']) != trim($_POST['confirm_password'])) {
                    $errors['confirm_password'] = 'Xác nhận mật khẩu không trùng khớp';
                }
            }
        }


        if (empty($errors)) {
            $fullname = $_POST['fullname'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $status = $_POST['status'];

            if (!empty($passord)) {
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $this->user->updateUser($id, $fullname, $phone, $email, $password, $status);
            } else {
                $this->user->updateUser($id, $fullname, $phone, $email, $status);
            }

            setFlashData('msg', 'Cập nhật người dùng thành công!');
            setFlashData('msg_type', 'success');
        } else {
            setFlashData('msg', 'Có lỗi xảy ra, vui lòng kiểm tra lại');
            setFlashData('msg_type', 'danger');
            setFlashData('errors', $errors);
            setFlashData('old', $_POST);
        }

        header("Location: " . BASE_URL . 'edit-user/' . $id);
    }
}