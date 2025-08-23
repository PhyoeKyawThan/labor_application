<?php
require_once __DIR__ . '/../../commons/Connection.php';

class AboutModel extends Connection{

    private $table_name = "about";

    public function get_about(){
        $query = "SELECT * FROM about LIMIT 1";
        $result = parent::$connection->query($query);
        $about = $result->fetch_assoc();
        return $about;
    }
}