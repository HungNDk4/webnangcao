<?php
include_once "../model/xl_data.php";
class  danhmuc
{
    private $id_dm = 0; // thuộc tính id_dm
    private $Name = ""; // thuộc tính tên danhmuc


    public function setId($id_dm)
    {
        return $this->id_dm = $id_dm;
    }
    public function getId()
    {
        return $this->id_dm;
    }
    public function setName($Name)
    {
        return  $this->Name = $Name;
    }
    public function getName()
    {
        return  $this->Name;
    }

    public function getDS_Danhmuc()
    {
        $xl = new xl_data();
        $sql = "SELECT * FROM `danhmuc`";
        $results = $xl->readitem($sql);
        return $results;
    }
    public function xoaDM($id)
    {
        $xl = new xl_data();
        $sql = "DELETE FROM `danhmuc` WHERE id=" . $id;
        $xl->execute_item($sql);
    }
    public function themDM(danhmuc $dm)
    {
        $xl = new xl_data();
        //cách viết câu sql

        $sql = "INSERT INTO `danhmuc` (`id`, `name`) 
            VALUES (NULL, '" . $dm->getName() . "')";
        //gọi hàm thực thi câu sql trong xl_data
        $xl->execute_item($sql);
    }

    // Lấy một danh mục
    public function motDM($id)
    {
        $xl = new xl_data();
        $sql = "SELECT * FROM `danhmuc` WHERE id=" . $id;
        $results = $xl->readitem($sql);
        return $results;
    }

    // Cập nhật danh mục
    public function capnhatDM(danhmuc $dm)
    {
        $xl = new xl_data();
        $sql = "UPDATE `danhmuc` SET `name` = '" . $dm->getName() . "' WHERE `danhmuc`.`id` = " . $dm->getId();
        $xl->execute_item($sql);
    }
}
