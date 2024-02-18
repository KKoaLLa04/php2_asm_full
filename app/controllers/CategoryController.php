<?php

namespace App\Controllers;

use App\Models\Category;

class CategoryController extends BaseController
{
    private $category;
    public function __construct()
    {
        $this->category = new Category;
    }

    public function index()
    {
        $listCate = $this->category->listCate();
        $msg = getFlashData('msg');
        $msg_type = getFlashData('msg_type');
        return $this->render('category.list', compact('listCate', 'msg', 'msg_type'));
    }

    public function addCate()
    {
        $msg = getFlashData('msg');
        $msg_type = getFlashData('msg_type');
        $errors = getFlashData('errors');
        $old = getFlashData('old');
        return $this->render('category.add', compact('msg', 'msg_type', 'errors', 'old'));
    }

    public function postCate()
    {
        $errors = [];

        if (empty($_POST['title'])) {
            $errors['title'] = 'Tiêu đề danh mục không được để trống';
        }

        if (empty($errors)) {
            $title = trim($_POST['title']);
            $date = date('Y-m-d H:i:s');

            $this->category->insertCate($title, $date);

            setFlashData('msg', 'Them danh muc san pham moi thanh cong!');
            setFLashData('msg_type', 'success');
        } else {
            setFlashData('msg', 'Có lỗi xảy ra, vui lòng kiểm tra lại!');
            setFlashData('msg_type', 'danger');
            setFlashData('errors', $errors);
            setFlashData('old', $_POST);
            setFlashData('msg_type', 'danger');
        }
        header("Location: " . BASE_URL . 'add-cate');
    }

    public function editCate($id)
    {
        if (empty($id)) {
            setFlashData('msg', 'Liên kết không tồn tại hoặc đã hết hạn');
            setFlashData('msg_type', 'danger');
            header("Location: " . BASE_URL . 'list-cate');
        } else {
            $cateDetail = $this->category->cateDetail($id);
            if (empty($cateDetail)) {
                setFlashData('msg', 'Danh mục không tồn tại hoặc đã bị xóa');
                setFlashData('msg_type', 'danger');
                header("Location: " . BASE_URL . 'list-cate');
            }
        }
        $msg = getFlashData('msg');
        $msg_type = getFlashData('msg_type');
        $errors = getFlashData('errors');
        $old = getFlashData('old');

        return $this->render('category.edit', compact('cateDetail', 'msg', 'msg_type', 'errors', 'old'));
    }

    public function editPostCate($id)
    {
        $errors = [];

        if (empty($_POST['title'])) {
            $errors['title'] = 'Tiêu đề danh mục không được để trống';
        }

        if (empty($errors)) {
            $title = trim($_POST['title']);
            $date = date('Y-m-d H:i:s');

            $this->category->updateCate($title, $date, $id);

            setFlashData('msg', 'Cap nhat danh muc san pham thanh cong!');
            setFLashData('msg_type', 'success');
        } else {
            setFlashData('msg', 'Có lỗi xảy ra, vui lòng kiểm tra lại!');
            setFlashData('msg_type', 'danger');
            setFlashData('errors', $errors);
            setFlashData('old', $_POST);
            setFlashData('msg_type', 'danger');
        }
        header("Location: " . BASE_URL . 'edit-cate/' . $id);
    }

    public function deleteCate($id)
    {
        $checkForeignKey = $this->category->checkForeignKey($id);
        if (!empty($checkForeignKey)) {
            setFlashData("msg", 'Danh mục còn sản phẩm, không thể xóa');
            setFlashData("msg_type", 'danger');
        } else {
            $this->category->deleteCate($id);
            setFlashData('msg', 'Xóa danh mục thành công');
            setFlashData('msg_type', 'success');
        }
        header("Location: " . BASE_URL . 'list-cate');
    }
}
