<?php
require_once __DIR__ . '/../../commons/Connection.php';

class EmployeeReqFormModel extends Connection
{
    private $details_table = "employee_req_form";
    private $numbers_table = "serial_numbers";

    public function createDetails($data)
    {
        $stmt = parent::$connection->prepare("INSERT INTO $this->details_table(
            name, 
            position, 
            department_address, 
            phone, 
            occupation,
            report_receiver,
            letter_no,
            user_id
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssi", 
            $data['name'],
            $data['position'],
            $data['department_address'],
            $data['phone'],
            $data['occupation'],
            $data['report_receiver'],
            $data['letter_no'],
            $data['user_id']
        );
        
        $stmt->execute();
        return $stmt->insert_id; 
    }

    public function createEmployeeNumbers($form_id, $serial_numbers)
    {
        $sql = "INSERT INTO $this->numbers_table(form_id, serial_number) VALUES (?, ?)";
        $stmt = parent::$connection->prepare($sql);
        
        foreach ($serial_numbers as $number) {
            $stmt->bind_param("is", $form_id, $number);
            $stmt->execute();
        }
        return true;
    }

    public function readDetails($form_id)
    {
        $stmt = parent::$connection->prepare("SELECT * FROM $this->details_table WHERE id = ?");
        $stmt->bind_param("i", $form_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function readEmployeeNumbers($form_id)
    {
        $stmt = parent::$connection->prepare("SELECT serial_number FROM $this->numbers_table WHERE form_id = ?");
        $stmt->bind_param("i", $form_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $numbers = [];
        while ($row = $result->fetch_assoc()) {
            $numbers[] = $row['serial_number'];
        }
        return $numbers;
    }

    public function updateDetails($form_id, $data)
    {
        $stmt = parent::$connection->prepare("UPDATE $this->details_table SET 
            name = ?, 
            position = ?, 
            department_address = ?, 
            po_box_number = ?, 
            phone = ?, 
            report_receiver = ?
            WHERE id = ?");

        $stmt->bind_param("ssssssi",
            $data['name'],
            $data['position'],
            $data['department_address'],
            $data['po_box_number'],
            $data['phone'],
            $data['report_receiver'],
            $form_id
        );
        
        return $stmt->execute();
    }

    public function deleteForm($form_id)
    {
        $stmt = parent::$connection->prepare("DELETE FROM $this->details_table WHERE id = ?");
        $stmt->bind_param("i", $form_id);
        
        return $stmt->execute();
    }
}
