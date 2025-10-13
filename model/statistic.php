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
        // PHẢI JOIN THÊM BẢNG ORDERS ĐỂ LỌC THEO NGÀY
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
    /**
     * Lấy 5 sản phẩm bán ế nhất.
     * @return array Danh sách sản phẩm
     */
    public function getLeastSellingProducts()
    {
        $xl = new xl_data();
        // Dùng LEFT JOIN để lấy cả những sản phẩm CHƯA TỪNG được bán (total_sold sẽ là NULL).
        // COALESCE(SUM(od.quantity), 0) để đổi NULL thành 0.
        // Sắp xếp tăng dần và lấy 5 sản phẩm đầu tiên.
        $sql = "SELECT p.name, p.image, COALESCE(SUM(od.quantity), 0) AS total_sold
                FROM products p
                LEFT JOIN order_details od ON p.id = od.product_id
                GROUP BY p.id
                ORDER BY total_sold ASC
                LIMIT 5";

        return $xl->readitem($sql);
    }

    public function getTopInventoryProducts()
    {

        $xl = new xl_data();

        $sql = 'SELECT * FROM products order by quantity desc limit 5';

        return $xl->readitem($sql);
    }
}
