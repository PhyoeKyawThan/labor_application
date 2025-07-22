<?php

class LaborsApplication extends Connection{
    private $table_name = "applications";
    public $table_datas = null;

    public function getApplications()
    {
        $result = parent::$connection->query("SELECT * FROM $this->table_name");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}