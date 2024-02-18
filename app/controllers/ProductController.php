<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Product;

class ProductController extends BaseController
{
    public $product;
    public function __construct()
    {
        $this->product = new Product();
    }

    public function index()
    {
        $data = $this->product->getProduct();
        $msg = getFlashData("msg");
        $msg_type = getFlashData("msg_type");
        return $this->render('product.list', compact('data', 'msg', 'msg_type'));
    }

    public function addProduct()
    {
        $msg = getFlashData('msg');
        $msg_type = getFlashData('msg_type');
        $errors = getFlashData('errors');
        $old = getFlashData('old');

        $allCate = $this->product->getAllCate();
        return $this->render('product.add', compact('msg', 'msg_type', 'errors', 'old', 'allCate'));
    }

    public function postProduct()
    {
        // check validate
        $errors = [];
        if (empty($_POST['title'])) {
            $errors['title'] = 'Tiêu đề không được để trống';
        }

        if (empty($_POST['description'])) {
            $errors['description'] = 'Mô tả không được để trống';
        }

        if (empty($_POST['price'])) {
            $errors['price'] = 'Giá không được để trống';
        }

        if (empty($_POST['quantity'])) {
            $errors['quantity'] = 'Số lượng không được để trống';
        }

        if (empty($_POST['content'])) {
            $errors['content'] = 'Nội dung không được để trống';
        }

        if (empty($_POST['cate_id'])) {
            $errors['cate_id'] = 'Vui lòng chọn thể loại sản phẩm';
        }

        if (empty($_FILES['thumbnail']['name'])) {
            $errors['thumbnail'] = 'Vui lòng chọn ảnh minh họa';
        }

        if (empty($errors)) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $content = $_POST['content'];
            $cateId = $_POST['cate_id'];

            // Handle image
            $thumbnailName = $_FILES['thumbnail']['name'];
            $from = $_FILES['thumbnail']['tmp_name'];
            $to = 'public/uploads/' . $thumbnailName;
            move_uploaded_file($from, $to);

            $insertStatus = $this->product->insertProduct($title, $thumbnailName, $description, $price, $content, $quantity, $cateId);
            setFlashData('msg', 'Thêm sản phẩm thành công');
            setFlashData('msg_type', 'success');
        } else {
            setFlashData('msg', 'Có lỗi xảy ra, vui lòng kiểm tra lại dữ liệu nhập vào');
            setFlashData('msg_type', 'danger');
            setFlashData('errors', $errors);
            setFlashData('old', $_POST);
        }
        header("Location: " . BASE_URL . 'add-product');
    }

    public function editProduct($id)
    {
        $msg = getFlashData('msg');
        $msg_type = getFlashData('msg_type');
        $errors = getFlashData('errors');
        $old = getFlashData('old');
        $allCate = $this->product->getAllCate();
        if (empty($id)) {
            setFlashData('msg', 'Lien ket khong ton tai hoac da het han!');
            setFlashData('msg_type', 'danger');
            header("Location: " . BASE_URL . 'list-product');
        }

        $productDetail = $this->product->getDetailProduct($id);
        if (empty($productDetail)) {
            setFLashData('msg', 'San pham khong ton tai hoac da bi xoa!');
            setFLashData('msg_type', 'danger');
            header("Location: " . BASE_URL . 'list-product');
        }

        return $this->render('product.edit', compact('productDetail', 'msg', 'msg_type', 'errors', 'old', 'allCate'));
    }

    public function editPost($id)
    {
        $errors = [];

        if (empty($_POST['title'])) {
            $errors['title'] = 'Tiêu đề không được để trống';
        }

        if (empty($_POST['description'])) {
            $errors['description'] = 'Mô tả không được để trống';
        }

        if (empty($_POST['price'])) {
            $errors['price'] = 'Giá không được để trống';
        }

        if (empty($_POST['quantity'])) {
            $errors['quantity'] = 'Số lượng không được để trống';
        }

        if (empty($_POST['content'])) {
            $errors['content'] = 'Nội dung không được để trống';
        }

        if (empty($_POST['cate_id'])) {
            $errors['cate_id'] = 'Vui lòng chọn thể loại sản phẩm';
        }

        if (empty($errors)) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $content = $_POST['content'];
            $cateId = $_POST['cate_id'];

            // Handle image
            if (!empty($_FILES['thumbnail']['name'])) {
                $thumbnailName = $_FILES['thumbnail']['name'];
                $from = $_FILES['thumbnail']['tmp_name'];
                $to = 'public/uploads/' . $thumbnailName;
                move_uploaded_file($from, $to);

                $updateStatus = $this->product->updateProduct($title, $description, $price, $content, $quantity, $id, $cateId, $thumbnailName);
            } else {
                $updateStatus = $this->product->updateProduct($title, $description, $price, $content, $quantity, $id, $cateId);
            }


            setFLashData('msg', 'Cap nhat san pham thanh cong!');
            setFLashData('msg_type', 'success');
            header("Location: " . BASE_URL . 'edit-product/' . $id);
        } else {
            setFlashData('msg', 'Có lỗi xảy ra, vui lòng kiểm tra lại dữ liệu nhập vào');
            setFlashData('msg_type', 'danger');
            setFlashData('errors', $errors);
            setFlashData('old', $_POST);
        }
        header("Location: " . BASE_URL . 'edit-product/' . $id);
    }

    public function deleteProduct($id)
    {
        $this->product->deletePro($id);
        setFlashData('msg', 'Xóa sản phẩm thành công!');
        setFlashData('msg_type', 'success');
        header("Location: " . BASE_URL . 'list-product');
    }
}
