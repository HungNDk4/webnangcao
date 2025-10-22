<?php
class order
{

    /**
     * Tạo một đơn hàng mới trong bảng 'orders'.
     * @param int $user_id ID của người dùng
     * @param string $fullname Tên người nhận
     * @param string $email Email người nhận
     * @param string $phone_number SĐT người nhận
     * @param string $address Địa chỉ người nhận
     * @param string $note Ghi chú
     * @param float $total_money Tổng tiền
     * @return string ID của đơn hàng vừa được tạo
     */
    public function createOrder($user_id, $fullname, $email, $phone_number, $address, $note, $total_money)
    {
        $xl = new xl_data();
        $sql = "INSERT INTO orders (user_id, fullname, email, phone_number, address, note, total_money) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $params = [$user_id, $fullname, $email, $phone_number, $address, $note, $total_money];

        // Sử dụng một hàm mới trong xl_data để trả về ID cuối cùng
        $last_id = $xl->execute_return_last_id($sql, $params);
        return $last_id;
    }

    /**
     * Thêm chi tiết đơn hàng vào bảng 'order_details'.
     * @param int $order_id ID của đơn hàng
     * @param int $product_id ID của sản phẩm
     * @param int $quantity Số lượng
     * @param float $price Giá tại thời điểm mua
     */
    public function addOrderDetail($order_id, $product_id, $quantity, $price)
    {
        $xl = new xl_data();
        $sql = "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
        $params = [$order_id, $product_id, $quantity, $price];
        $xl->execute_item($sql, $params);
    }
    public function getOrdersByUserId($user_id)
    {
        $xl = new xl_data();
        $sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC";
        $params = [$user_id];
        return $xl->readitem($sql, $params);
    }

    public function getOrderById($order_id)
    {
        $xl = new xl_data();
        $sql = "SELECT * FROM orders WHERE id = ?";
        $params = [$order_id];
        $result = $xl->readitem($sql, $params);
        return $result[0] ?? null;
    }

    /**
     * Lấy danh sách sản phẩm trong một đơn hàng.
     * @param int $order_id ID của đơn hàng
     * @return array Mảng chứa các sản phẩm
     */
    public function getOrderDetailsByOrderId($order_id)
    {
        $xl = new xl_data();
        // Dùng JOIN để lấy thêm tên và ảnh sản phẩm từ bảng 'products'
        $sql = "SELECT od.*, p.name, p.image 
                FROM order_details od
                JOIN products p ON od.product_id = p.id
                WHERE od.order_id = ?";
        $params = [$order_id];
        return $xl->readitem($sql, $params);
    }
    /**
     * Lấy TẤT CẢ các đơn hàng trong hệ thống.
     * @return array Mảng chứa tất cả đơn hàng
     */
    public function getAllOrders()
    {
        $xl = new xl_data();
        $sql = "SELECT * FROM orders ORDER BY created_at DESC";
        return $xl->readitem($sql);
    }

    public function updateOrderStatus($order_id, $status)
    {
        $xl = new xl_data();
        $sql = "UPDATE orders SET status = ? WHERE id = ?";
        $params = [$status, $order_id];
        $xl->execute_item($sql, $params);
    }
    public function hasUserPurchasedProduct($user_id, $product_id)
    {
        $xl = new xl_data();
        // Câu lệnh SQL này JOIN hai bảng, tìm ra có dòng nào khớp cả user_id và product_id không.
        $sql = "SELECT COUNT(*) 
                FROM orders o
                JOIN order_details od ON o.id = od.order_id
                WHERE o.user_id = ? AND od.product_id = ?";
        $params = [$user_id, $product_id];
        $result = $xl->readitem($sql, $params);

        // Nếu số lượng kết quả > 0, tức là họ đã mua.
        return $result[0]['COUNT(*)'] > 0;
    }
    public function getNewOrders($limit = 8)
    {
        $xl_data = new xl_data();
        $sql = "SELECT * FROM orders ORDER BY created_at DESC LIMIT ?";
        $params = [$limit];
        return $xl_data->readitem($sql, $params);
    }
    public function countAllOrders()
    {
        $xl_data = new xl_data();
        $sql = "SELECT COUNT(id) as total FROM orders";
        $result = $xl_data->readitem($sql);
        return $result[0]['total'];
    }

    /**
     * Lấy đơn hàng theo từng trang.
     * @param int $limit Số lượng đơn hàng trên mỗi trang
     * @param int $offset Vị trí bắt đầu lấy
     * @return array Mảng chứa các đơn hàng của trang hiện tại
     */
    public function getOrdersByPage($limit, $offset)
    {
        $xl_data = new xl_data();
        $sql = "SELECT * FROM orders ORDER BY id DESC LIMIT ? OFFSET ?";
        $params = [(int)$limit, (int)$offset];
        return $xl_data->readitem($sql, $params);
    }
    /**
     * Tìm kiếm đơn hàng theo ID, tên, email, hoặc SĐT.
     * @param string $keyword Từ khóa tìm kiếm
     * @return array Mảng chứa các đơn hàng tìm thấy
     */
    public function searchOrders($keyword)
    {
        $xl = new xl_data();
        $sql = "SELECT * FROM orders 
                WHERE id = ? OR fullname LIKE ? OR email LIKE ? OR phone_number LIKE ?
                ORDER BY order_date DESC";
        // Tìm chính xác ID, hoặc gần đúng với tên, email, sđt
        $params = [$keyword, "%" . $keyword . "%", "%" . $keyword . "%", "%" . $keyword . "%"];
        return $xl->readitem($sql, $params);
    }
}
