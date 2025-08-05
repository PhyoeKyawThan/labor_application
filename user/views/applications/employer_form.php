<?php
require_once __DIR__ . '/../../models/EmployeeReqFormModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $model = new EmployeeReqFormModel();
    $formData = [
        'name' => trim($_POST['name']),
        'position' => trim($_POST['position']),
        'department_address' => trim($_POST['department_address']),
        'occupation' => json_encode($_POST['occupation']),
        'phone' => trim($_POST['phone']),
        'report_receiver' => trim($_POST['report_receiver']),
        'user_id' => $_SESSION['user_id']
    ];

    $form_id = $model->createDetails($formData);

    $employee_numbers = array_filter($_POST['employee'], fn($e) => !empty($e));

    if (!empty($employee_numbers)) {
        $model->createEmployeeNumbers($form_id, $employee_numbers);
        $_SESSION['applied'] = true;
    }
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
            <label for="phone">Phone Number</label>
            <input type="tel" name="phone" id="phone">
        </div>
    </div>

    <div class="form-group">
        <label for="report-receiver">Name and position of the person to whom the workers must report.</label>
        <textarea name="report_receiver" id="report-receiver"></textarea>
    </div>
    <div id="occupied_work_container">
        <div class="occupied-work-group" id="occupied-work-group-0">
            <div class="form-row">
                <div class="form-group">
                    <label for="occupation-0">Occupation</label>
                    <input type="text" name="occupation[0][occupation]" id="occupation-0">
                </div>
                <div class="form-group">
                    <label for="male-0">Male</label>
                    <input type="number" name="occupation[0][male]" id="male-0">

                    <label for="female-0">Female</label>
                    <input type="number" name="occupation[0][female]" id="female-0">
                </div>
                <div class="form-group">
                    <label for="qualification-0">Qualification</label>
                    <input type="text" name="occupation[0][qualification]" id="qualification-0">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="position-0">Position</label>
                    <input type="text" name="occupation[0][position]" id="position-0">
                </div>
                <div class="form-group">
                    <label for="salary-0">Salary</label>
                    <input type="text" name="occupation[0][salary]" id="salary-0">
                </div>
            </div>
        </div>
    </div>
    <button type="button" onclick="addOccupiedWork()" class="add-button">Add Occupied Work</button>
    <div id="employee-container">
        <div class="form-group" id="employee-group-0">
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
        max-width: 900px;
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

    .occupied-work-group {
        border: 1px solid #d1d5db;
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1rem;
        background-color: #f9fafb;
    }

    input[type="text"],
    input[type="tel"],
    input[type="number"],
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

    .remove-button {
        margin-top: 0.5rem;
        background-color: #f87171;
        /* Red */
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        cursor: pointer;
        display: inline-block;
    }

    .remove-button:hover {
        background-color: #dc2626;
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
        newDiv.id = `employee-group-${employeeCount}`;

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

        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.innerText = 'Remove';
        removeBtn.classList.add('remove-button');
        removeBtn.onclick = () => removeEmployee(newDiv.id);

        newDiv.appendChild(label);
        newDiv.appendChild(input);
        newDiv.appendChild(statusSpan);
        newDiv.appendChild(removeBtn);
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
    function removeEmployee(id) {
        const element = document.getElementById(id);
        if (element) {
            element.remove();
        }
    }

    let occupiedWorkCount = 1;

    function addOccupiedWork() {
        const container = document.getElementById('occupied_work_container');

        const groupId = `occupied-work-group-${occupiedWorkCount}`;
        const newDiv = document.createElement('div');
        newDiv.classList.add('occupied-work-group');
        newDiv.id = groupId;

        newDiv.innerHTML = `
        <div class="form-row">
            <div class="form-group">
                <label for="occupation-${occupiedWorkCount}">Occupation</label>
                <input type="text" name="occupation[${occupiedWorkCount}][occupation]" id="occupation-${occupiedWorkCount}">
            </div>
            <div class="form-group">
                <label for="male-${occupiedWorkCount}">Male</label>
                <input type="number" name="occupation[${occupiedWorkCount}][male]" id="male-${occupiedWorkCount}">

                    <label for="female-${occupiedWorkCount}">Female</label>
                    <input type="number" name="occupation[${occupiedWorkCount}][female]" id="female-${occupiedWorkCount}">
                    </div>
                    <div class="form-group">
                        <label for="qualification-${occupiedWorkCount}">Qualification</label>
                        <input type="text" name="occupation[${occupiedWorkCount}][qualification]" id="qualification-${occupiedWorkCount}">
                    </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="position-${occupiedWorkCount}">Position</label>
                    <input type="text" name="occupation[${occupiedWorkCount}][position]" id="position-${occupiedWorkCount}">
                </div>
                <div class="form-group">
                    <label for="salary-${occupiedWorkCount}">Salary</label>
                    <input type="text" name="occupation[${occupiedWorkCount}][salary]" id="salary-${occupiedWorkCount}">
                </div>
            </div>
            <button type="button" class="remove-button" onclick="removeOccupiedWork('${groupId}')">Remove</button>
        `;

        container.appendChild(newDiv);
        occupiedWorkCount++;
    }

    function removeOccupiedWork(id) {
        const element = document.getElementById(id);
        if (element) {
            element.remove();
        }
    }


</script>