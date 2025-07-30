<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
class LaborsApplication extends Connection
{
    private $table_name = "applications";
    public $table_datas = null;
    public $id = 1;

    public function getApplications()
    {
        $result = parent::$connection->query("SELECT * FROM $this->table_name");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getApplicationById($id)
    {
        $stmt = parent::$connection->prepare("SELECT * FROM {$this->table_name} WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateStatus(){
        if($this->id > 0){
            $stmt = parent::$connection->prepare("UPDATE applications SET status = ?, message = ? WHERE id = ?");
            $types = parent::get_types($this->table_datas) ;
            $stmt->bind_param($types, ...$this->table_datas);
            return $stmt->execute();
        }
    }

}