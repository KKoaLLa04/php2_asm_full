<?php

namespace App\Models;

use App\Models\BaseModel;

class Category extends BaseModel
{
    private $table = 'category';
    public function listCate()
    {
        $sql = "SELECT * FROM $this->table";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    public function insertCate($title, $date)
    {
        $sql = "INSERT INTO $this->table (`title`, `created_at`) VALUES ('$title', '$date')";
        $this->setQuery($sql);
        $this->execute();
    }

    public function cateDetail($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id=$id";
        $this->setQuery($sql);
        return $this->loadRow();
    }

    public function updateCate($title, $date, $id)
    {
        $sql = "UPDATE $this->table SET `title`='$title', `updated_at`='$date' WHERE id=$id";
        $this->setQuery($sql);
        $this->execute();
    }

    public function deleteCate($id)
    {
        $sql = "DELETE FROM $this->table WHERE id=$id";
        $this->setQuery($sql);
        $this->execute();
    }

    public function checkForeignKey($cate_id)
    {
        $sql = "SELECT * FROM product WHERE cate_id=$cate_id";
        $this->setQuery($sql);
        return $this->loadRow();
    }
}
