<?php

require_once __DIR__ . '/../../../commons/Connection.php';

class ReportDataGenerator extends Connection
{   
    public $months;
    public $year;
    private function getFinishedForm()
    {
        $stmt_req = parent::$connection->query("SELECT id FROM employee_req_form WHERE status = 'Finished' AND YEAR(a.registration_date) = $this->year AND MONTH(a.registration_date) = $this->months");
        return $stmt_req->fetch_all(MYSQLI_ASSOC);
    }

    public function getEmployedLabors()
    {
        $finished_form = $this->getDepartments();
        $labors = [];
        if ($finished_form) {
            foreach ($finished_form as $f) {
                $finished_serials = parent::$connection->prepare("SELECT a.gender, a.age FROM serial_numbers as sn
        JOIN applications as a ON sn.serial_number = a.serial_number WHERE sn.form_id = ?");
                $finished_serials->bind_param('i', $f['id']);
                $finished_serials->execute();
                $labors = $finished_serials->get_result()->fetch_all(MYSQLI_ASSOC);
            }
        }
        return $labors;
    }

    public function getNewLabors()
    {
        return parent::$connection->query("SELECT a.age, a.gender FROM applications as a WHERE a.status = 'Approved' AND YEAR(a.registration_date) = $this->year AND MONTH(a.registration_date) = $this->months")->fetch_all(MYSQLI_ASSOC);
    }

    public function getLaborsWithEdu()
    {
        $labors = [];
        foreach ($this->getEduLevels() as $edu) {
            $edu = $edu['edu_level'];
            $labors[$edu] = parent::$connection->query("SELECT a.age, a.gender FROM applications as a WHERE a.status = 'Approved' AND a.edu_level = '$edu' AND YEAR(a.registration_date) = $this->year AND MONTH(a.registration_date) = $this->months")->fetch_all(MYSQLI_ASSOC);
        }
        return $labors;
    }

    public function getDepartmentPositionEmployedLabors()
    {
        $employed_labors = [];
        foreach($this->getDepartments() as $dep){
            $occupation = json_decode($dep['occupation'], true)[0];
            $employed_labors[] = [
                "department" => $dep['name'],
                "address" => $dep['department_address'],
                "occupation" => $occupation
            ];
        }
        return $employed_labors;
    }

    private function getEduLevels()
    {
        return parent::$connection->query("SELECT DISTINCT edu_level FROM applications")->fetch_all(MYSQLI_ASSOC);
    }

    private function getDepartments()
    {
        return parent::$connection->query("SELECT r.id, r.name, r.occupation, r.department_address FROM employee_req_form as r JOIN department_approval as da ON da.employee_req_id = r.id WHERE status = 'Finished' AND YEAR(da.approval_req_date) = $this->year AND MONTH(da.approval_req_date) = $this->months")->fetch_all(MYSQLI_ASSOC);
    }
}

// $r = new ReportDataGenerator();
// print_r($r->getDepartmentPositionEmployedLabors());