<?php
class review
{

    /**
     * Thêm một đánh giá mới vào database.
     * @param int $product_id
     * @param int $user_id
     * @param int $rating Số sao, từ 1 đến 5
     * @param string $comment Nội dung bình luận
     */
    public function addReview($product_id, $user_id, $rating, $comment)
    {
        $xl = new xl_data();
        $sql = "INSERT INTO reviews (product_id, user_id, rating, comment) VALUES (?, ?, ?, ?)";
        $params = [$product_id, $user_id, $rating, $comment];
        $xl->execute_item($sql, $params);
    }


    /**
     * Lấy tất cả đánh giá của một sản phẩm, kèm theo tên người đánh giá.
     * @param int $product_id
     * @return array Mảng các đánh giá
     */
    public function getReviewsByProductId($product_id)
    {
        $xl = new xl_data();
        // Dùng JOIN để lấy tên của người dùng từ bảng 'users'
        $sql = "SELECT r.*, u.fullname 
                FROM reviews r 
                JOIN users u ON r.user_id = u.id 
                WHERE r.product_id = ? 
                ORDER BY r.created_at DESC";
        $params = [$product_id];
        return $xl->readitem($sql, $params);
    }
    public function getAllReviewsWithProductInfo()
    {
        $xl_data = new xl_data();
        $sql = "SELECT 
                    r.*, 
                    u.fullname, 
                    p.name as product_name,
                    p.image as product_image
                FROM 
                    reviews r
                JOIN 
                    users u ON r.user_id = u.id
                JOIN 
                    products p ON r.product_id = p.id
                ORDER BY 
                    r.created_at DESC";
        return $xl_data->readitem($sql);
    }

    /**
     * Xóa một đánh giá theo ID.
     * @param int $id
     */
    public function deleteReview($id)
    {
        $xl = new xl_data();
        $sql = "DELETE FROM reviews WHERE id = ?";
        $params = [$id];
        $xl->execute_item($sql, $params);
    }
    /**
     * Tìm kiếm đánh giá theo tên sản phẩm, email người dùng, hoặc nội dung bình luận.
     * @param string $keyword Từ khóa tìm kiếm
     * @return array Mảng chứa các đánh giá tìm thấy
     */
    /**
     * Tìm kiếm đánh giá theo tên sản phẩm, email người dùng, hoặc nội dung bình luận.
     * @param string $keyword Từ khóa tìm kiếm
     * @return array Mảng chứa các đánh giá tìm thấy
     */
    public function searchReviews($keyword)
    {
        $xl = new xl_data();

        // SỬA LẠI SQL:
        // Cần SELECT giống hệt hàm getAllReviewsWithProductInfo()
        // để view có đủ 2 cột 'fullname' và 'product_image'
        $sql = "SELECT 
                    r.*, 
                    u.fullname,  
                    p.name as product_name,
                    p.image as product_image 
                FROM 
                    reviews r
                JOIN 
                    users u ON r.user_id = u.id
                JOIN 
                    products p ON r.product_id = p.id
                WHERE 
                    p.name LIKE ? OR u.email LIKE ? OR r.comment LIKE ?
                ORDER BY 
                    r.created_at DESC";

        $search_term = "%" . $keyword . "%";
        // Cung cấp đủ 3 tham số cho 3 dấu ?
        $params = [$search_term, $search_term, $search_term];

        return $xl->readitem($sql, $params);
    }
}
