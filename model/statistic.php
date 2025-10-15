<?php
class statistic
{

    public function getTotalRevenue($start_date, $end_date)
    {
        $xl = new xl_data();
        $sql = "SELECT SUM(total_money) AS total_revenue FROM orders WHERE status = 'completed' AND created_at BETWEEN ? AND ?";
        $params = [$start_date, $end_date];
        $result = $xl->readitem($sql, $params);
        return $result[0]['total_revenue'] ?? 0;
    }

    public function getTotalOrders($start_date, $end_date)
    {
        $xl = new xl_data();
        $sql = "SELECT COUNT(*) AS total_orders FROM orders WHERE created_at BETWEEN ? AND ?";
        $params = [$start_date, $end_date];
        $result = $xl->readitem($sql, $params);
        return $result[0]['total_orders'] ?? 0;
    }

    public function getTotalCustomers($start_date, $end_date)
    {
        $xl = new xl_data();
        $sql = "SELECT COUNT(*) AS total_customers FROM users WHERE role = 'customer' AND created_at BETWEEN ? AND ?";
        $params = [$start_date, $end_date];
        $result = $xl->readitem($sql, $params);
        return $result[0]['total_customers'] ?? 0;
    }

    public function getTopSellingProducts($start_date, $end_date)
    {
        $xl = new xl_data();
        $sql = "SELECT p.name, p.image, SUM(od.quantity) AS total_sold
                FROM order_details od
                JOIN products p ON od.product_id = p.id
                JOIN orders o ON od.order_id = o.id
                WHERE o.created_at BETWEEN ? AND ?
                GROUP BY od.product_id
                ORDER BY total_sold DESC
                LIMIT 5";
        $params = [$start_date, $end_date];
        return $xl->readitem($sql, $params);
    }

    // HÀM NÀY CŨNG PHẢI LỌC THEO NGÀY
    public function getLeastSellingProducts($start_date, $end_date)
    {
        $xl = new xl_data();
        $sql = "SELECT p.name, p.image, COALESCE(SUM(od.quantity), 0) AS total_sold
                FROM products p
                LEFT JOIN order_details od ON p.id = od.product_id
                LEFT JOIN orders o ON od.order_id = o.id AND o.created_at BETWEEN ? AND ?
                GROUP BY p.id
                ORDER BY total_sold ASC
                LIMIT 5";
        $params = [$start_date, $end_date];
        return $xl->readitem($sql, $params);
    }

    // HÀM NÀY KHÔNG PHỤ THUỘC THỜI GIAN, GIỮ NGUYÊN
    public function getTopInventoryProducts()
    {
        $xl = new xl_data();
        $sql = 'SELECT name, image, quantity FROM products ORDER BY quantity DESC LIMIT 5';
        return $xl->readitem($sql);
    }
    /* ----- BẮT ĐẦU CODE MỚI ----- */
    /**
     * Tính tổng số tiền một người dùng đã chi tiêu cho các đơn hàng đã hoàn thành.
     * @param int $user_id
     * @return float
     */
    public function getTotalSpentByUser($user_id)
    {
        $xl = new xl_data();
        $sql = "SELECT SUM(total_money) AS total_spent FROM orders WHERE user_id = ? AND status = 'completed'";
        $params = [$user_id];
        $result = $xl->readitem($sql, $params);
        return $result[0]['total_spent'] ?? 0;
    }
}
