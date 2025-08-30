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
            serial_number,
            position, 
            department_address, 
            phone, 
            occupation,
            report_receiver_name,
            report_receiver_position,
            report_receiver_address,
            report_receiver_time,
            letter_no,
            signature,
            user_id
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $serial_number = $this->serial_number_generator();
        $stmt->bind_param(
            "ssssssssssssi",
            $data['name'],
            $serial_number,
            $data['position'],
            $data['department_address'],
            $data['phone'],
            $data['occupation'],
            $data['report_receiver_name'],
            $data['report_receiver_position'],
            $data['report_receiver_address'],
            $data['report_receiver_time'],
            $data['letter_no'],
            $data['signature'],
            $data['user_id']
        );

        $stmt->execute();
        return $stmt->insert_id;
    }

    private function serial_number_generator()
    {
        $query = mysqli_query(parent::$connection, "SELECT * FROM employee_req_form ORDER BY id DESC LIMIT 1");
        $latest_application = mysqli_fetch_assoc($query);
        if (isset($latest_application['id'])):
            $latest_application_date = new DateTime($latest_application['submitted_at']);
            $latest_application_yr = $latest_application_date->format('Y');
            $current_date = new DateTime();
            $current_year = $current_date->format('Y');

            if ($current_year != $latest_application_yr) {
                return '000001';
            } else {
                $latest_app_serial_num = isset($latest_application['serial_number'])
                    ? (int) $latest_application['serial_number']
                    : 0;
                $next_serial = $latest_app_serial_num + 1;
                return str_pad((string) $next_serial, 6, '0', STR_PAD_LEFT);
            }
        endif;
        return '001';
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

    public function readFormById($user_id)
    {
        $stmt = parent::$connection->prepare("SELECT * FROM $this->details_table WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
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

    public function deleteForm($form_id)
    {
        $stmt = parent::$connection->prepare("DELETE FROM $this->details_table WHERE id = ?");
        $stmt->bind_param("i", $form_id);

        return $stmt->execute();
    }
}
