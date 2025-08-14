<?php
require_once __DIR__ . '/../../commons/Connection.php';
class ApplicationModel extends Connection
{
    private $table_name = "applications";
    public $table_datas = null;
    public $application_id = 0;

    public function check_serial($serial_number)
    {
        try {
            $stmt = parent::$connection->prepare("SELECT id FROM applications WHERE serial_number = ? AND status = 'Approved'");
            $stmt->bind_param("s", $serial_number);
            $stmt->execute();
            $serial = $stmt->get_result()->fetch_assoc();
            if ($serial) {
                if ($this->check_status($serial_number)) {
                    return true;
                }
                return false;
            }
            return false;
            
        } catch (Exception $e) {
            echo json_encode([
                "err" => $e->getMessage()
            ]);
            exit;
        }
    }

    private function check_status($serial_number)
    {
        $checkstmt = parent::$connection->query("SELECT sn.*,rq.status FROM serial_numbers as sn JOIN employee_req_form as rq ON rq.id = sn.form_id WHERE serial_number = '$serial_number'");
        $serial_status = $checkstmt->fetch_assoc();
        if ($serial_status) {
            if ($serial_status['status'] == 'Finished' || $serial_status['status'] == 'Pending') {
                return false;
            }
            if($serial_status['Rejected']){
                return true;
            }
        }
        return true;
    }

    public function addApplication()
    {
        $stmt = parent::$connection->prepare("INSERT INTO $this->table_name(
                name,
                fatherName, 
                age,
                nrc, 
                serial_number, 
                township, 
                phone, 
                email, 
                birth_date, 
                gender, 
                religion, 
                edu_level,  
                stable_address, 
                picture, 
                images, 
                user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $types = parent::get_types(array_values($this->table_datas));
        $stmt->bind_param($types, ...$this->table_datas);
        return $stmt->execute();
    }

    public function getApplication($user_id, $type)
    {
        $stmt = parent::$connection->prepare("SELECT * FROM $this->table_name WHERE user_id = ?");
        if ($type == 'employer') {
            $stmt = parent::$connection->prepare("SELECT * FROM employee_req_form WHERE user_id = ?");
        }
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateApplication()
    {
        $set = [];
        $params = [];
        $types = '';

        foreach ($this->table_datas as $key => $value) {
            if ($key !== 'user_id') {
                $set[] = "$key = ?";
                $params[] = $value;
                $types .= parent::resolve_type($value);
            }
        }

        $params[] = $this->table_datas['user_id'];
        $types .= 'i';

        $qry = "UPDATE {$this->table_name} SET " . implode(', ', $set) . " WHERE user_id = ?";
        $stmt = parent::$connection->prepare($qry);
        $stmt->bind_param($types, ...$params);
        return $stmt->execute();
    }

}
// $m = new ApplicationModel();
// print_r($m->check_serial('002'));
?>