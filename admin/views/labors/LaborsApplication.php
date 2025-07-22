<?php

class LaborsApplication extends Connection
{
    private $table_name = "applications";
    public $table_datas = null;

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

}