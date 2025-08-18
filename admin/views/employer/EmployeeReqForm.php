<?php
require_once __DIR__ . '/../../../commons/Connection.php';

class EmployeeReqForm extends Connection
{
    private $details_table = "employee_req_form";
    private $numbers_table = "serial_numbers";

    public function createDetails($data)
    {
        $stmt = parent::$connection->prepare("INSERT INTO $this->details_table(
            name, 
            position, 
            department_address, 
            po_box_number, 
            phone, 
            report_receiver
        ) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "ssssss",
            $data['name'],
            $data['position'],
            $data['department_address'],
            $data['po_box_number'],
            $data['phone'],
            $data['report_receiver']
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
        $stmt = parent::$connection->prepare("
        SELECT r.*, da.toDeliver, da.approval_req_date, u.id as uid FROM $this->details_table as r JOIN users as u ON u.id = r.user_id
        LEFT JOIN department_approval as da ON da.employee_req_id = r.id WHERE r.id = ?");
        $stmt->bind_param("i", $form_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function readEmployeeNumbers($form_id)
    {
        $form_id = (int) $form_id;
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

    public function readEmployeeDetails($form_id)
    {
        $employee_numbers = $this->readEmployeeNumbers($form_id);
        $emplyoees = [];
        foreach ($employee_numbers as $e) {
            $stmt = parent::$connection->query("SELECT * FROM applications WHERE serial_number = '$e'");
            $emplyoees[] = $stmt->fetch_assoc();
        }

        return $emplyoees;
    }

    public function search($kw)
    {
        $kw = '%' . $kw . '%';
        $stmt = parent::$connection->prepare("
        SELECT * 
        FROM employee_req_form
        WHERE name LIKE ? OR position LIKE ? 
        ORDER BY id DESC
    ");
        $stmt->bind_param('ss', $kw, $kw);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insertDepartmentApproval($datas)
    {
        $sql = "INSERT INTO department_approval (
                toDeliver, 
                department_name, 
                approval_req_date, 
                employee_req_id
            ) VALUES (?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE
                toDeliver = VALUES(toDeliver),
                department_name = VALUES(department_name),
                approval_req_date = VALUES(approval_req_date)";

        $stmt = parent::$connection->prepare($sql);
        $stmt->bind_param('sssi', ...$datas);
        return $stmt->execute();
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

        $stmt->bind_param(
            "ssssssi",
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

    public function changeStatus($form_id, $status)
    {
        return parent::$connection->query("UPDATE employee_req_form SET status = '$status' WHERE id = $form_id");
        ;
    }

    public function saveConfirmDataFromEmployer($form_id, $status, $sign, $stamp){
        $query = parent::$connection->prepare("UPDATE employee_req_form SET status = ?, department_confirm_sign = ?, department_confirm_stamp = ? WHERE id = ?");
        $query->bind_param("sssi", $status, $sign, $stamp, $form_id);
        return $query->execute();
    }

    public function readAll()
    {
        $query = parent::$connection->query("SELECT * FROM employee_req_form ORDER BY id DESC");
        return $query->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteForm($form_id)
    {
        $stmt = parent::$connection->prepare("DELETE FROM $this->details_table WHERE id = ?");
        $stmt->bind_param("i", $form_id);

        return $stmt->execute();
    }
}
