<?php

namespace App\Models;

use App\Models\BaseModel;

class Product extends BaseModel
{
    private $table = 'product';
    // public function __construct()
    // {
    //     parent::__construct();
    // }

    public function getProduct()
    {
        $sql = "SELECT $this->table.*, category.title as cate_title FROM $this->table INNER JOIN category ON category.id=$this->table.cate_id";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    public function insertProduct($title, $thumbnail, $description, $price, $content, $quantity, $cateId)
    {
        $sql = "INSERT INTO `product`(`title`, `thumbnail`, `description`, `price`, `content`, `quantity`, `cate_id`) VALUES ('$title','$thumbnail','$description','$price','$content','$quantity', '$cateId')";
        $this->setQuery($sql);
        $this->execute();
    }

    public function getDetailProduct($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id=$id";
        $this->setQuery($sql);
        return $this->loadRow();
    }

    public function updateProduct($title, $description, $price, $content, $quantity, $id, $cateId, $thumbnail = '')
    {
        if (!empty($thumbnail)) {
            $sql = "UPDATE $this->table SET `title`='$title',`description`='$description', `price`='$price', `content`='$content', `quantity`='$quantity',`cate_id`='$cateId', `thumbnail`='$thumbnail' WHERE id=$id";
        } else {
            $sql = "UPDATE $this->table SET `title`='$title',`description`='$description', `price`='$price', `content`='$content', `quantity`='$quantity',`cate_id`='$cateId' WHERE id=$id";
        }
        $this->setQuery($sql);
        $this->execute();
    }

    public function deletePro($id)
    {
        $sql = "DELETE FROM `product` WHERE id=$id";
        $this->setQuery($sql);
        $this->execute();
    }

    public function getAllCate()
    {
        $sql = "SELECT * FROM category";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }
}
