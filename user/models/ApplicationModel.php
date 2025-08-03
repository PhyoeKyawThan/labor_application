<?php
require_once __DIR__ . '/../../commons/Connection.php';
class ApplicationModel extends Connection
{
    private $table_name = "applications";
    public $table_datas = null;
    public $application_id = 0;

    public function check_serial($serial_number){
        $stmt = parent::$connection->prepare("SELECT id FROM applications WHERE serial_number = ? AND status = 'Approved'");
        $stmt->bind_param("s", $serial_number);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function addApplication()
    {
        $stmt = parent::$connection->prepare("INSERT INTO $this->table_name(
                name, 
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
                user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $types = parent::get_types(array_values($this->table_datas));
        $stmt->bind_param($types, ...$this->table_datas);
        return $stmt->execute();
    }

    public function getApplication($user_id)
    {
        $stmt = parent::$connection->prepare("SELECT * FROM $this->table_name WHERE user_id = ?");
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
?>