<?php

class user
{
    // 1. Khai báo các thuộc tính private tương ứng với các cột trong bảng 'users'
    private $id;
    private $fullname;
    private $email;
    private $password;
    private $phone_number;
    private $address;
    private $role;
    private $status;
    private $rank;
    // 2. Tạo các hàm get/set cho từng thuộc tính
    public function getId()
    {
        return $this->id;
    }
    public function setId($value)
    {
        $this->id = $value;
    }

    public function getFullname()
    {
        return $this->fullname;
    }
    public function setFullname($value)
    {
        $this->fullname = $value;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($value)
    {
        $this->email = $value;
    }

    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($value)
    {
        $this->password = $value;
    }

    public function getPhoneNumber()
    {
        return $this->phone_number;
    }
    public function setPhoneNumber($value)
    {
        $this->phone_number = $value;
    }

    public function getAddress()
    {
        return $this->address;
    }
    public function setAddress($value)
    {
        $this->address = $value;
    }

    public function getRole()
    {
        return $this->role;
    }
    public function setRole($value)
    {
        $this->role = $value;
    }

    public function getStatus()
    {
        return $this->status;
    }
    public function setStatus($value)
    {
        $this->status = $value;
    }
    // <-- THÊM HÀM GET/SET CHO RANK -->
    public function getRank()
    {
        return $this->rank;
    }
    public function setRank($value)
    {
        $this->rank = $value;
    }

    // 3. Cập nhật các hàm xử lý database

    /**
     * Thêm một người dùng mới vào database.
     * @param user $user Đối tượng user chứa thông tin cần thêm
     */
    public function addUser(user $user_data)
    {
        $xl = new xl_data();
        // Thêm cột 'role' vào câu lệnh INSERT
        $sql = "INSERT INTO users (fullname, email, password, role) VALUES (?, ?, ?, ?)";
        $params = [
            $user_data->getFullname(),
            $user_data->getEmail(),
            $user_data->getPassword(),
            $user_data->getRole() // Lấy vai trò từ đối tượng
        ];
        $xl->execute_item($sql, $params);
    }
    /**
     * Kiểm tra xem một email đã tồn tại trong bảng users hay chưa.
     * @param string $email Email cần kiểm tra
     * @return bool True nếu email đã tồn tại, False nếu chưa.
     */
    public function checkEmailExists($email)
    {
        $xl = new xl_data();
        $sql = "SELECT COUNT(*) FROM users WHERE email = ?";
        $params = [$email];
        $result = $xl->readitem($sql, $params);
        return $result[0]['COUNT(*)'] > 0;
    }

    /**
     * Lấy thông tin của một người dùng dựa trên email.
     * @param string $email Email của người dùng
     * @return user|null Trả về một đối tượng user nếu tìm thấy, hoặc null nếu không.
     */
    public function getUserByEmail($email)
    {
        $xl = new xl_data();
        $sql = "SELECT * FROM users WHERE email = ?";
        $params = [$email];
        $result = $xl->readitem($sql, $params);

        if (count($result) > 0) {
            $user_data = $result[0];
            $user_obj = new user();
            $user_obj->setId($user_data['id']);
            $user_obj->setFullname($user_data['fullname']);
            $user_obj->setEmail($user_data['email']);
            $user_obj->setPassword($user_data['password']);
            $user_obj->setPhoneNumber($user_data['phone_number']);
            $user_obj->setAddress($user_data['address']);
            $user_obj->setRole($user_data['role']);
            $user_obj->setStatus($user_data['status']);
            $user_obj->setRank($user_data['rank']); // <-- CẬP NHẬT Ở ĐÂY

            return $user_obj;
        }

        return null;
    }
    /**
     * Lấy tất cả người dùng (khách hàng) trong hệ thống.
     * @return array Mảng chứa tất cả người dùng
     */
    public function getAllCustomers()
    {
        $xl = new xl_data();
        // Thêm điều kiện WHERE để chỉ lấy role 'customer'
        $sql = "SELECT * FROM users WHERE role = 'customer' ORDER BY created_at DESC";
        return $xl->readitem($sql);
    }

    /**
     * Cập nhật trạng thái (status) của một người dùng.
     * @param int $user_id ID của người dùng
     * @param int $status Trạng thái mới (0: Khóa, 1: Hoạt động)
     */
    public function updateUserStatus($user_id, $status)
    {
        $xl = new xl_data();
        $sql = "UPDATE users SET status = ? WHERE id = ?";
        $params = [$status, $user_id];
        $xl->execute_item($sql, $params);
    }
    public function getAllStaff()
    {
        $xl = new xl_data();
        // Lấy tất cả user có role là 'staff' hoặc 'admin'
        $sql = "SELECT * FROM users WHERE role IN ('staff', 'admin') ORDER BY role, created_at DESC";
        return $xl->readitem($sql);
    }
    /**
     * THÊM HÀM MỚI: Xóa một người dùng theo ID
     * @param int $user_id
     */
    public function deleteUser($user_id)
    {
        $xl = new xl_data();
        $sql = "DELETE FROM users WHERE id = ?";
        $params = [$user_id];
        $xl->execute_item($sql, $params);
    }
    /* ----- BẮT ĐẦU CODE MỚI ----- */
    /**
     * Cập nhật hạng của người dùng dựa trên tổng chi tiêu.
     * @param int $user_id
     */
    public function updateUserRank($user_id)
    {
        // 1. Lấy tổng chi tiêu
        $stat_model = new statistic();
        $total_spent = $stat_model->getTotalSpentByUser($user_id);

        // 2. Xác định hạng mới
        // BẠN CÓ THỂ THAY ĐỔI CÁC MỐC CHI TIÊU NÀY
        $new_rank = 'Silver'; // Hạng mặc định
        if ($total_spent >= 15000000) { // Trên 15 triệu
            $new_rank = 'Diamond';
        } elseif ($total_spent >= 5000000) { // Từ 5 triệu đến dưới 15 triệu
            $new_rank = 'Gold';
        }

        // 3. Cập nhật vào database
        $xl = new xl_data();
        $sql = "UPDATE users SET `rank` = ? WHERE id = ?";
        $params = [$new_rank, $user_id];
        $xl->execute_item($sql, $params);
    }
    public function countAllCustomers()
    {
        $xl_data = new xl_data();
        $sql = "SELECT COUNT(id) as total FROM users WHERE role = 'customer'";
        $result = $xl_data->readitem($sql);
        return $result[0]['total'];
    }

    /**
     * Lấy khách hàng theo từng trang.
     * @param int $limit Số lượng khách hàng trên mỗi trang
     * @param int $offset Vị trí bắt đầu lấy
     * @return array Mảng chứa các khách hàng của trang hiện tại
     */
    public function getCustomersByPage($limit, $offset)
    {
        $xl_data = new xl_data();
        $sql = "SELECT * FROM users WHERE role = 'customer' ORDER BY id DESC LIMIT ? OFFSET ?";
        $params = [(int)$limit, (int)$offset];
        return $xl_data->readitem($sql, $params);
    }
}
