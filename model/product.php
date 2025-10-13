<?php
class product
{
    // Thuộc tính tương ứng với bảng 'products'
    private $id;
    private $category_id;
    private $name;
    private $price;
    private $sale_price;
    private $quantity;
    private $image;
    private $description;

    // Getters & Setters
    public function getId()
    {
        return $this->id;
    }
    public function setId($value)
    {
        $this->id = $value;
    }
    public function getCategoryId()
    {
        return $this->category_id;
    }
    public function setCategoryId($value)
    {
        $this->category_id = $value;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setName($value)
    {
        $this->name = $value;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function setPrice($value)
    {
        $this->price = $value;
    }
    public function getSalePrice()
    {
        return $this->sale_price;
    }
    public function setSalePrice($value)
    {
        $this->sale_price = $value;
    }
    public function getQuantity()
    {
        return $this->quantity;
    }
    public function setQuantity($value)
    {
        $this->quantity = $value;
    }
    public function getImage()
    {
        return $this->image;
    }
    public function setImage($value)
    {
        $this->image = $value;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function setDescription($value)
    {
        $this->description = $value;
    }

    // Lấy tất cả sản phẩm
    public function getAllProducts()
    {
        $xl = new xl_data();
        $sql = "SELECT * FROM products ORDER BY id DESC";
        return $xl->readitem($sql);
    }

    // Lấy một sản phẩm theo ID
    public function getProductById($id)
    {
        $xl = new xl_data();
        $sql = "SELECT * FROM products WHERE id = ?";
        $params = [$id];
        $result = $xl->readitem($sql, $params);
        return $result[0] ?? null;
    }

    // Thêm sản phẩm mới
    public function addProduct(product $prod)
    {
        $xl = new xl_data();
        $sql = "INSERT INTO products (name, price, quantity, image, description, category_id, sale_price) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $params = [
            $prod->getName(),
            $prod->getPrice(),
            $prod->getQuantity(),
            $prod->getImage(),
            $prod->getDescription(),
            $prod->getCategoryId(),
            $prod->getSalePrice()
        ];
        $xl->execute_item($sql, $params);
    }

    // Cập nhật sản phẩm
    public function updateProduct(product $prod)
    {
        $xl = new xl_data();
        $sql = "UPDATE products 
                SET name = ?, price = ?, quantity = ?, image = ?, description = ?, category_id = ?, sale_price = ?
                WHERE id = ?";
        $params = [
            $prod->getName(),
            $prod->getPrice(),
            $prod->getQuantity(),
            $prod->getImage(),
            $prod->getDescription(),
            $prod->getCategoryId(),
            $prod->getSalePrice(),
            $prod->getId()
        ];
        $xl->execute_item($sql, $params);
    }

    // Xóa sản phẩm
    public function deleteProduct($id)
    {
        $xl = new xl_data();
        $sql = "DELETE FROM products WHERE id = ?";
        $params = [$id];
        $xl->execute_item($sql, $params);
    }
    /**
     * Tìm kiếm sản phẩm theo tên.
     * @param string $keyword Từ khóa tìm kiếm
     * @return array Mảng chứa các sản phẩm tìm thấy
     */
    public function searchProducts($keyword)
    {
        $xl = new xl_data();
        // Dùng LIKE để tìm các sản phẩm có tên chứa từ khóa
        $sql = "SELECT * FROM products WHERE name LIKE ?";
        // Thêm dấu % để tìm kiếm gần đúng
        $params = ["%" . $keyword . "%"];
        return $xl->readitem($sql, $params);
    }
    public function updateProductQuantity($product_id, $quantity_sold)
    {
        $xl = new xl_data();
        // Dùng `quantity - ?` để trừ đi số lượng đã bán
        $sql = "UPDATE products SET quantity = quantity - ? WHERE id = ?";
        $params = [$quantity_sold, $product_id];
        $xl->execute_item($sql, $params);
    }
}
