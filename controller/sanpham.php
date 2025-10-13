<?php
class sanpham
{
    private $id;
    private $category_id;
    private  $name;
    private $price;
    private $sale_price;
    private $quantity;
    private $image;
    private $description;
    private $view_count;
    private $created_at;

    // --- GETTER / SETTER ---
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

    // viet function taoj san pham

    // viet function taoj san pham
    // --- CÁC HÀM TƯƠNG TÁC DATABASE ĐÃ SỬA LẠI ---

    public function getallsanpham()
    {
        $xl = new xl_data();
        // SỬA TÊN BẢNG TỪ 'sanpham' THÀNH 'products'
        $sql = "SELECT * FROM products";
        return $xl->readitem($sql);
    }

    public function themsp(sanpham $sp)
    {
        $xl = new xl_data();
        // SỬA TÊN BẢNG VÀ TÊN CỘT
        $sql = "INSERT INTO products (category_id, name, price, quantity, image, description) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $params = [
            $sp->getCategoryId(),
            $sp->getName(),
            $sp->getPrice(),
            $sp->getQuantity(),
            $sp->getImage(),
            $sp->getDescription()
        ];
        $xl->execute_item($sql, $params);
    }

    public function xoasp($id)
    {
        $xl = new xl_data();
        // SỬA TÊN BẢNG VÀ TÊN CỘT
        $sql = "DELETE FROM products WHERE id = ?";
        $params = [$id];
        $xl->execute_item($sql, $params);
    }

    public function motsp($id)
    {
        $xl = new xl_data();
        // SỬA TÊN BẢNG VÀ TÊN CỘT
        $sql = "SELECT * FROM products WHERE id = ?";
        $params = [$id];
        $results = $xl->readitem($sql, $params);
        return $results[0] ?? null; // Trả về 1 sản phẩm hoặc null
    }

    public function capnhatsp(sanpham $sp)
    {
        $xl = new xl_data();
        // SỬA TÊN BẢNG VÀ TÊN CỘT
        $sql = "UPDATE products 
                SET category_id = ?, name = ?, price = ?, quantity = ?, image = ?, description = ?
                WHERE id = ?";
        $params = [
            $sp->getCategoryId(),
            $sp->getName(),
            $sp->getPrice(),
            $sp->getQuantity(),
            $sp->getImage(),
            $sp->getDescription(),
            $sp->getId()
        ];
        $xl->execute_item($sql, $params);
    }
}
