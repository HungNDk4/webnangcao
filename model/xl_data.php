<?php
include_once "database.php";
class xl_data extends database
{
    // hàm đọc dữ liệu an toàn với tham số
    function readitem($sql, $params = [])
    {
        $stmt = $this->connection_database()->prepare($sql);
        $stmt->execute($params);
        $danhsach = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $danhsach;
    }

    // hàm thực thi (thêm, xóa, sửa) an toàn với tham số
    function execute_item($sql, $params = [])
    {
        $stmt = $this->connection_database()->prepare($sql);
        $stmt->execute($params);
    }
    // Hàm thực thi và trả về ID của dòng vừa insert
    function execute_return_last_id($sql, $params = [])
    {
        $conn = $this->connection_database();
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        return $conn->lastInsertId();
    }
}
