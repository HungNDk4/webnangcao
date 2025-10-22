<?php
class category
{
    private $id;
    private $name;

    public function getId()
    {
        return $this->id;
    }
    public function setId($value)
    {
        $this->id = $value;
    }

    public function getName()
    {
        return $this->name;
    }
    public function setName($value)
    {
        $this->name = $value;
    }

    // Lấy tất cả danh mục
    public function getAllCategories()
    {
        $xl = new xl_data();
        $sql = "SELECT * FROM categories ORDER BY id DESC";
        return $xl->readitem($sql);
    }

    // Lấy một danh mục theo ID
    public function getCategoryById($id)
    {
        $xl = new xl_data();
        $sql = "SELECT * FROM categories WHERE id = ?";
        $params = [$id];
        $result = $xl->readitem($sql, $params);
        return $result[0] ?? null;
    }

    // Thêm danh mục mới
    public function addCategory(category $cat)
    {
        $xl = new xl_data();
        $sql = "INSERT INTO categories (name) VALUES (?)";
        $params = [$cat->getName()];
        $xl->execute_item($sql, $params);
    }

    // Cập nhật danh mục
    public function updateCategory(category $cat)
    {
        $xl = new xl_data();
        $sql = "UPDATE categories SET name = ? WHERE id = ?";
        $params = [$cat->getName(), $cat->getId()];
        $xl->execute_item($sql, $params);
    }

    // Xóa danh mục
    public function deleteCategory($id)
    {
        $xl = new xl_data();
        $sql = "DELETE FROM categories WHERE id = ?";
        $params = [$id];
        $xl->execute_item($sql, $params);
    }
    /**
     * Tìm kiếm danh mục theo tên.
     * @param string $keyword Từ khóa tìm kiếm
     * @return array Mảng chứa các danh mục tìm thấy
     */
    public function searchCategories($keyword)
    {
        $xl = new xl_data();
        $sql = "SELECT * FROM categories WHERE name LIKE ?";
        $params = ["%" . $keyword . "%"];
        return $xl->readitem($sql, $params);
    }
}
