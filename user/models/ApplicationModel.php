<?php
require_once __DIR__ . '/../../commons/Connection.php';
class ApplicationModel extends Connection
{
    private $table_name = "applications";
    public $table_datas = null;
    private $connection = null;
    public function __construct()
    {
        $this->connection = parent::get_connection();
    }

    public function addApplication()
    {
        $stmt = $this->connection->prepare("INSERT INTO $this->table_name(
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
                images, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?, ?, ?)");
        $types = parent::get_types(array_values($this->table_datas));
        $stmt->bind_param($types, ...$this->table_datas);
        return $stmt->execute();
    }

    public function getApplication($user_id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM $this->table_name WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateApplication()
    {
        $stmt = $this->connection->prepare(
            "UPDATE $this->table_name SET 
            name = ?, 
            nrc = ?, 
            serial_number = ?, 
            township = ?, 
            phone = ?, 
            email = ?, 
            birth_date = ?, 
            gender = ?, 
            religion = ?, 
            edu_level = ?, 
            stable_address = ?, 
            picture = ?, 
            images = ?
        WHERE user_id = ?"
        );

        $types = parent::get_types(array_values($this->table_datas));
        $stmt->bind_param($types, ...$this->table_datas);
        return $stmt->execute();
    }

}
?>