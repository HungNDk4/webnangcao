<?php
class voucher
{
    private $id;
    private $code;
    private $discount_value;
    private $discount_type;
    private $quantity;
    private $expires_at;
    // Getters và Setters
    public function getId()
    {
        return $this->id;
    }
    public function setId($value)
    {
        $this->id = $value;
    }
    public function getCode()
    {
        return $this->code;
    }
    public function setCode($value)
    {
        $this->code = $value;
    }
    public function getDiscountValue()
    {
        return $this->discount_value;
    }
    public function setDiscountValue($value)
    {
        $this->discount_value = $value;
    }
    public function getDiscountType()
    {
        return $this->discount_type;
    }
    public function setDiscountType($value)
    {
        $this->discount_type = $value;
    }
    public function getQuantity()
    {
        return $this->quantity;
    }
    public function setQuantity($value)
    {
        $this->quantity = $value;
    }
    public function getExpiresAt()
    {
        return $this->expires_at;
    }
    public function setExpiresAt($value)
    {
        $this->expires_at = $value;
    }


    // --- HÀM CRUD (ĐÃ SỬA TÊN BẢNG) ---

    public function getVoucherByCode($code)
    {
        $xl = new xl_data();
        $sql = "SELECT * FROM vouchers WHERE code = ? AND quantity > 0 AND expires_at > NOW()"; // Sửa ở đây
        $params = [$code];
        $result = $xl->readitem($sql, $params);
        return $result[0] ?? null;
    }

    public function getAllVouchers()
    {
        $xl = new xl_data();
        $sql = "SELECT * FROM vouchers ORDER BY expires_at DESC"; // Sửa ở đây
        return $xl->readitem($sql);
    }

    public function getVoucherById($id)
    {
        $xl = new xl_data();
        $sql = "SELECT * FROM vouchers WHERE id = ?"; // Sửa ở đây
        $params = [$id];
        $result = $xl->readitem($sql, $params);
        return $result[0] ?? null;
    }

    public function addVoucher(voucher $v)
    {
        $xl = new xl_data();
        $sql = "INSERT INTO vouchers (code, discount_value, discount_type, quantity, expires_at) 
                VALUES (?, ?, ?, ?, ?)"; // Sửa ở đây
        $params = [
            $v->getCode(),
            $v->getDiscountValue(),
            $v->getDiscountType(),
            $v->getQuantity(),
            $v->getExpiresAt()
        ];
        $xl->execute_item($sql, $params);
    }

    public function updateVoucher(voucher $v)
    {
        $xl = new xl_data();
        $sql = "UPDATE vouchers 
                SET code = ?, discount_value = ?, discount_type = ?, quantity = ?, expires_at = ?
                WHERE id = ?"; // Sửa ở đây
        $params = [
            $v->getCode(),
            $v->getDiscountValue(),
            $v->getDiscountType(),
            $v->getQuantity(),
            $v->getExpiresAt(),
            $v->getId()
        ];
        $xl->execute_item($sql, $params);
    }

    public function deleteVoucher($id)
    {
        $xl = new xl_data();
        $sql = "DELETE FROM vouchers WHERE id = ?"; // Sửa ở đây
        $params = [$id];
        $xl->execute_item($sql, $params);
    }

    public function checkCodeExists($code)
    {
        $xl = new xl_data();
        $sql = "SELECT COUNT(*) FROM vouchers WHERE code = ?"; // Sửa ở đây
        $params = [$code];
        $result = $xl->readitem($sql, $params);
        return $result[0]['COUNT(*)'] > 0;
    }
}
