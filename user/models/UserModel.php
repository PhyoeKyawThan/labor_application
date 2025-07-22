<?php
require_once __DIR__ . '/../../commons/Connection.php';
class UserModel extends Connection
{
    private $table_name = "users";
    public $table_datas = null;
    public function register()
    {
        try {
            $stmt = parent::$connection->prepare("INSERT INTO users(username, email, password, type) VALUES(?, ?, ?, ?)");
            $types = parent::get_types($this->table_datas);
            $stmt->bind_param($types, ...$this->table_datas);

            if ($stmt->execute()) {
                return [
                    'success' => true,
                    'user' => $this->get_registered_user(),
                ];
            }
        } catch (Exception $e) {
            if ($stmt->errno == 1062) {
                return [
                    'sucess' => false,
                    'mail_exists' => true,
                ];
            }
            die("Exception: " . $e->getMessage());
        }
    }

    public function login()
    {
        try {
            $query = "SELECT * FROM users WHERE email = ?";
            $stmt = parent::$connection->prepare($query);
            $types = parent::get_types($this->table_datas['email']);
            $stmt->bind_param('s', $this->table_datas['email']);
            $stmt->execute();
            $result = $stmt->get_result();
            $mail_user = $result->fetch_assoc();
            if ($mail_user && password_verify($this->table_datas['password'], $mail_user['password'])) {
                return [
                    'success' => true,
                    'msg' => 'Login Success',
                    'user' => $mail_user
                ];
            }
            return [
                'success' => false,
                'msg' => 'Login Failed',
            ];
        } catch (Exception $e) {
            die("Exception: " . $e->getMessage());
        }
    }

    private function get_registered_user()
    {
        $user_id = (int) parent::$connection->insert_id;
        $query = "SELECT * FROM users WHERE id = $user_id";
        $qry = parent::$connection->query($query);
        return $qry->fetch_assoc();
    }
    
}