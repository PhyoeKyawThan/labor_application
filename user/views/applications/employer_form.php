<?php
require_once __DIR__ . '/../../models/EmployeeReqFormModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $model = new EmployeeReqFormModel();
    $formData = [
        'name'               => trim($_POST['name']),
        'position'           => trim($_POST['position']),
        'department_address' => trim($_POST['department_address']),
        'po_box_number'      => trim($_POST['po_box_number']),
        'phone'              => trim($_POST['phone']),
        'report_receiver'    => trim($_POST['report_receiver'])
    ];

    $form_id = $model->createDetails($formData);

    $employee_numbers = array_filter($_POST['employee'], fn($e) => !empty($e));

    if (!empty($employee_numbers)) {
        $model->createEmployeeNumbers($form_id, $employee_numbers);
    }

    // header("Location: thank_you.php");
    // exit;
}
?>

<form action="" method="post" class="modern-form">
    <h1 class="form-title">Employee Details</h1>

    <div class="form-row">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name">
        </div>
        <div class="form-group">
            <label for="position">Position</label>
            <input type="text" name="position" id="position">
        </div>
    </div>

    <div class="form-group">
        <label for="depart-address">Department Address</label>
        <textarea name="department_address" id="depart-address"></textarea>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="post-o-Box">Post Office Box Number</label>
            <input type="text" name="po_box_number" id="post-o-Box">
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" name="phone" id="phone">
        </div>
    </div>

    <div class="form-group">
        <label for="report-receiver">Name and position of the person to whom the workers must report.</label>
        <textarea name="report_receiver" id="report-receiver"></textarea>
    </div>

    <div id="employee-container">
        <div class="form-group">
            <label for="employee-0">Employee Number</label>
            <input type="text" name="employee[0]" id="employee-0">
            <span id="employee-status-0" class="validation-msg"></span>
        </div>
    </div>

    <div class="button-group">
        <button type="button" onclick="addEmployee()" class="add-button">Add Another Employee</button>
        <input type="submit" value="Submit" class="submit-button">
    </div>
</form>


<style>
    .modern-form {
        background-color: #ffffff;
        padding: 2.5rem;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 640px;
        box-sizing: border-box;
        margin: auto;
    }

    .form-title {
        font-size: 1.875rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .form-row {
        display: flex;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .form-row .form-group {
        flex: 1;
    }

    .form-group {
        margin-bottom: 1.5rem;
        position: relative;
    }

    .form-group:last-child {
        margin-bottom: 0;
    }

    label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
        margin-bottom: 0.25rem;
    }

    input[type="text"],
    input[type="tel"],
    textarea {
        width: 100%;
        padding: 0.5rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
        box-sizing: border-box;
    }

    input:focus,
    textarea:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.25);
    }

    textarea {
        resize: vertical;
        min-height: 5rem;
    }

    .button-group {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        margin-top: 2rem;
    }

    .add-button,
    .submit-button {
        width: 100%;
        padding: 0.75rem 1rem;
        font-weight: 500;
        border: none;
        border-radius: 0.5rem;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .add-button {
        background-color: #e5e7eb;
        color: #374151;
    }

    .add-button:hover {
        background-color: #d1d5db;
    }

    .submit-button {
        background-color: #2563eb;
        color: #ffffff;
    }

    .submit-button:hover {
        background-color: #1d4ed8;
    }

    /* Styles for validation feedback */
    .validation-msg {
        font-size: 0.75rem;
        display: block;
        height: 1.25rem;
        /* Reserve space */
        margin-top: 0.25rem;
    }

    .validation-msg.valid {
        color: #10b981;
        /* Green color for success */
    }

    .validation-msg.invalid {
        color: #ef4444;
        /* Red color for error */
    }

    input.is-invalid {
        border-color: #ef4444;
    }

    input.is-valid {
        border-color: #10b981;
    }

    /* Responsive adjustments */
    @media (min-width: 768px) {
        .button-group {
            flex-direction: row;
        }
    }
</style>
<script>
    let employeeCount = 1;
    const form = document.querySelector('.modern-form');
    let serial_numbers = [];
    async function validateEmployee(inputElement, statusElement) {
        const serial_number = inputElement.value;
        statusElement.innerText = 'Checking...';
        statusElement.classList.remove('valid', 'invalid');
        inputElement.classList.remove('is-valid', 'is-invalid');
        inputElement.setAttribute('data-valid', 'false');

        if (serial_number.length === 0) {
            statusElement.innerText = '';
            return;
        }

        const employeeInputs = document.querySelectorAll('#employee-container input[type="text"]');
        let isDuplicate = false;
        employeeInputs.forEach(input => {
            if (input.id !== inputElement.id && input.value === serial_number) {
                isDuplicate = true;
            }
        });

        if (isDuplicate) {
            statusElement.innerText = 'Duplicate serial number.';
            statusElement.classList.add('invalid');
            inputElement.classList.add('is-invalid');
            inputElement.setAttribute('data-valid', 'false');
            return;
        }
        try {
            const response = await fetch('/labor_application/user/actions/check_serial.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    'serial_number': serial_number
                })
            });
            const data = await response.json();

            if (data.status) {
                statusElement.innerText = data.msg;
                statusElement.classList.add('valid');
                inputElement.classList.add('is-valid');
                inputElement.setAttribute('data-valid', 'true');
                serial_numbers.push(serial_number);
            } else {
                statusElement.innerText = data.msg;
                statusElement.classList.add('invalid');
                inputElement.classList.add('is-invalid');
                inputElement.setAttribute('data-valid', 'false');
            }
        } catch (error) {
            console.error('Error during validation:', error);
            statusElement.innerText = 'Network error. Please try again.';
            statusElement.classList.add('invalid');
            inputElement.classList.add('is-invalid');
            inputElement.setAttribute('data-valid', 'false');
        }
    }


    function addEmployee() {
        const container = document.getElementById('employee-container');

        const newDiv = document.createElement('div');
        newDiv.classList.add('form-group');

        const label = document.createElement('label');
        label.setAttribute('for', `employee-${employeeCount}`);
        label.innerText = 'Employee Number';

        const input = document.createElement('input');
        input.type = 'text';
        input.name = `employee[${employeeCount}]`;
        input.id = `employee-${employeeCount}`;
        input.setAttribute('data-valid', 'false');

        const statusSpan = document.createElement('span');
        statusSpan.id = `employee-status-${employeeCount}`;
        statusSpan.classList.add('validation-msg');

        input.addEventListener('blur', () => validateEmployee(input, statusSpan));

        newDiv.appendChild(label);
        newDiv.appendChild(input);
        newDiv.appendChild(statusSpan);
        container.appendChild(newDiv);

        employeeCount++;
    }

    document.addEventListener('DOMContentLoaded', () => {
        const initialInput = document.getElementById('employee-0');
        const initialStatus = document.getElementById('employee-status-0');
        initialInput.addEventListener('blur', () => validateEmployee(initialInput, initialStatus));
        initialInput.setAttribute('data-valid', 'false');
    });

    form.addEventListener('submit', function (event) {
        const employeeInputs = document.querySelectorAll('#employee-container input[type="text"]');
        let allValid = true;

        employeeInputs.forEach(input => {
            if (input.getAttribute('data-valid') !== 'true') {
                allValid = false;
            }
        });

        if (!allValid) {
            event.preventDefault();
            alert("Please correct all invalid employee numbers before submitting the form.");
        }
    });
</script>