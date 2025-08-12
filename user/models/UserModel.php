<?php
require_once __DIR__ . '/../../commons/Connection.php';
class UserModel extends Connection
{
    private $table_name = "users";
    public $user_id = 0;
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

    public function get_registered_application($type)
    {
        try {
            if ($type == 'employee') {
                $query = parent::$connection->prepare("SELECT * FROM applications WHERE user_id = ?");
            }else{
                $query = parent::$connection->prepare("SELECT * FROM employee_req_form WHERE user_id = ?");
            }
            $query->bind_param('i', $this->user_id);
            mysqli_execute($query);
            $result = $query->get_result();
            $application = $result->fetch_assoc();
            return $application;
        } catch (Exception $e) {
            die("Error while getting user's registered application");
        }
    }

    public function get_registered_status($type)
    {
        try {
            $query = parent::$connection->prepare("SELECT status, is_resubmit FROM applications WHERE user_id = ?");
            if($type == 'employer'){
                $query = parent::$connection->prepare("SELECT status, is_resubmit FROM employee_req_form WHERE user_id = ?");
            }
            $query->bind_param('i', $this->user_id);
            mysqli_execute($query);
            $result = $query->get_result();
            $application = $result->fetch_assoc();
            return $application;
        } catch (Exception $e) {
            die("Error while getting user's registered application");
        }
    }
}