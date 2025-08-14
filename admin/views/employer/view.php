<?php
$detail = $reqModel->readDetails($_GET['fid']);

/**
 * Converts a Gregorian date string into a formatted Myanmar date string.
 *
 * @param string $date_string The date string from the database (e.g., '2025-02-20 10:30:00').
 * @return string The formatted Myanmar date string.
 */
function formatMyanmarDate($date_string)
{
    if (empty($date_string)) {
        return '';
    }

    $date = new DateTime($date_string);

    // Myanmar numbers mapping
    $myanmar_numbers = ['၀', '၁', '၂', '၃', '၄', '၅', '၆', '၇', '၈', '၉'];
    $myanmar_months = [
        1 => 'ဇန်နဝါရီ',
        2 => 'ဖေဖော်ဝါရီ',
        3 => 'မတ်',
        4 => 'ဧပြီ',
        5 => 'မေ',
        6 => 'ဇွန်',
        7 => 'ဇူလိုင်',
        8 => 'ဩဂုတ်',
        9 => 'စက်တင်ဘာ',
        10 => 'အောက်တိုဘာ',
        11 => 'နိုဝင်ဘာ',
        12 => 'ဒီဇင်ဘာ'
    ];


    $year = $date->format('Y');
    $month = (int) $date->format('m');
    $day = $date->format('d');


    $myanmar_year = str_replace(range(0, 9), $myanmar_numbers, $year);
    $myanmar_day = str_replace(range(0, 9), $myanmar_numbers, $day);


    $myanmar_month_name = $myanmar_months[$month];


    return $myanmar_year . ' ခုနှစ်၊ ' . $myanmar_month_name . ' လ၊ ' . $myanmar_day . ' ရက်';
}

function getMyanmarDateComponents($date_string)
{
    if (empty($date_string)) {
        return [];
    }

    try {
        $date = new DateTime($date_string);
    } catch (Exception $e) {
        return []; // Return an empty array on invalid date
    }

    $myanmar_numbers = ['၀', '၁', '၂', '၃', '၄', '၅', '၆', '၇', '၈', '၉'];
    $myanmar_months = [
        1 => '၀၁',
        2 => '၀၂',
        3 => '၀၃',
        4 => '၀၄',
        5 => '၀၅',
        6 => '၀၆',
        7 => '၀၇',
        8 => '၀၈',
        9 => '၀၉',
        10 => '၁၀',
        11 => '၁၁',
        12 => '၁၂'
    ];

    $year = $date->format('Y');
    $month = (int) $date->format('m');
    $day = $date->format('d');

    $myanmar_year = str_replace(range(0, 9), $myanmar_numbers, $year);
    $myanmar_day = str_replace(range(0, 9), $myanmar_numbers, $day);
    $myanmar_month_name = $myanmar_months[$month];

    return [
        'year' => $myanmar_year,
        'month' => $myanmar_month_name,
        'day' => $myanmar_day,
    ];
}

$formatted_date = formatMyanmarDate($detail['submitted_at']);

if (isset($_GET['pf'])) {
    require __DIR__ . '/prefilled_form.php';
    exit;
}

?>

<style>
    body {
        background-color: #f0f0f0;
        margin: 0;
        font-family: sans-serif;
    }

    .card-list-container {
        max-width: 1200px;
        margin: 20px auto;
        padding: 20px;
        background-color: whitesmoke;
        border-radius: 8px;
        box-shadow: 0 0 3px;
    }

    .card-header {
        text-align: center;
        margin-bottom: 20px;
        font-size: 24px;
        font-weight: bold;
        color: #333;
    }

    .card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .data-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        transition: transform 0.2s ease-in-out;
    }

    .data-card:hover {
        transform: translateY(-5px);
    }

    .card-item {
        margin-bottom: 10px;
        font-size: 16px;
    }

    .card-item-label {
        font-weight: bold;
        color: #555;
    }

    .print-button-container {
        text-align: center;
        margin-top: 20px;
    }

    .print-button {
        padding: 12px 30px;
        font-size: 16px;
        font-weight: bold;
        color: white;
        background-color: #007bff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.2s ease-in-out;
    }

    .print-button:hover {
        background-color: #0056b3;
    }


    .printable-form {
        display: none;
    }

    .form-container {
        width: 210mm;
        min-height: 297mm;
        padding: 20mm;
        margin: 20mm auto;
        background: white;
        box-sizing: border-box;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        font-size: 14px;
        line-height: 1.5;
    }

    .header {
        text-align: center;
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .details {
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        margin-bottom: 20px;
    }

    th,
    td {
        border: 2px solid whitesmoke;
        padding: 8px;
        text-align: center;
        font-size: 12px;
    }

    #signature {
        margin-top: 60px;
        text-align: right;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }

    #signature img {
        display: block;
        margin-bottom: 5px;
    }

    .to {
        margin-top: 40px;
    }

    .actions {
        display: flex;
        justify-content: end;
    }

    .actions a {
        text-decoration: none;
        border-radius: 8px;
        padding: 8px 20px;
        background-color: #0057b387;
        color: white;
        font-weight: bold;
        transition: 0.3s ease-in;
    }

    .actions a:hover {
        background-color: #007bff;
    }


    @media print {
        @page {
            size: A4;
            margin: 20mm !important;
        }

        body {
            background: none !important;
            margin: 0;
        }

        .card-list-container {
            display: none;
        }

        .printable-form {
            display: block !important;
            width: auto;
            min-height: auto;
            margin: 0;
            padding: 0;
            box-shadow: none;
            page-break-after: always;
        }

        table,
        #signature {
            page-break-inside: avoid;
        }
    }

    .employer-detail {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .header_ {
        display: flex;
        justify-content: start;
        align-items: center;
        gap: 20px;
        background-color: whitesmoke;
        padding: 0px 18px;
        border-radius: 8px;
        box-shadow: 0 0 3px;
    }
</style>
<div class="header_">
    <a href="/labor_application/admin/?vr=employer">
        <i class="fas fa-arrow-left"></i>
    </a>
    <h3>Employee Requests form</h3>
    <?php
    $status = $detail['status'];

    $bgColor = match ($status) {
        'Pending' => 'background-color: gold; color: black;',
        'Department Approvel' => 'background-color: royalblue; color: white;',
        'Finished' => 'background-color: green; color: white;',
        'Rejected' => 'background-color: red; color: white;',
        default => 'background-color: gray; color: white;',
    };
    ?>

    <span style="<?= $bgColor ?> padding: 3px 8px; border-radius: 4px;">
        <?= htmlspecialchars($status) ?>
    </span>

</div>
<div class="card-list-container">
    <div class="print-button-container">
        <button id="printButton" class="print-button"><i class="fas fa-print"></i> Print As Form</button>
    </div>
    <div class="employer-detail">
        <div>
            <strong>Name:</strong> <?= $detail['name'] ?>
        </div>
        <div>
            <strong>Position:</strong> <?= $detail['position'] ?>
        </div>
        <div>
            <strong>Department Address:</strong> <?= $detail['department_address'] ?>
        </div>
        <div>
            <strong>Phone: </strong> <?= $detail['phone'] ?>
        </div>
        <div>
            <strong>Report receiver: </strong> <?= $detail['report_receiver'] ?>
        </div>
        <div>
            <strong>Submitted Date: </strong> <?= $detail['submitted_at'] ?>
        </div>
    </div>
    <div class="card-header">Required Worker Details</div>
    <div class="card-grid">
        <?php
        foreach (json_decode($detail['occupation'], true) as $d):
            ?>
            <div class="data-card">
                <div class="card-item"><span class="card-item-label">Position:</span> <?= $d['occupation'] ?></div>
                <div class="card-item"><span class="card-item-label">Skill:</span> <?= $d['skill'] ?></div>
                <div class="card-item"><span class="card-item-label">Required Male Count:</span> <?= $d['male'] ?></div>
                <div class="card-item"><span class="card-item-label">Required Female Count:</span> <?= $d['female'] ?></div>
                <div class="card-item"><span class="card-item-label">Qualification:</span> <?= $d['qualification'] ?></div>
                <div class="card-item"><span class="card-item-label">Salary:</span> <?= $d['salary'] ?></div>
            </div>
        <?php endforeach; ?>
    </div>
    <h1>Requested Employees</h1>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Serial Number</th>
                <th>Education</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($reqModel->readEmployeeDetails($_GET['fid']) as $index => $emp):
            ?>
            <tr>
                <td><?= ++$index ?></td>
                <td><?= $emp['name'] ?></td>
                <td><?= $emp['serial_number'] ?></td>
                <td><?= $emp['edu_level'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <hr>
    <div class="actions">
        <a href="<?= $_SERVER['REQUEST_URI'] ?>&pf=true">Request an approval Of the requested Department</a>
    </div>
</div>

<div class="printable-form">
    <div id="form-container" class="form-container">
        <div class="header">
            <div>Form 1</div>
            <div>Ah Kaung Kyar Sar</div>
        </div>

        <div class="details">
            <div>၁။ name/position/address
                <b><?= $detail['name'] . ' ၊ ' . $detail['position'] . ' ၊ ' . $detail['department_address'] ?></b>
            </div>
            <div>၂။ phone <b><?= $detail['phone'] ?></b></div>
            <div>၃။ report receiver name <b><?= $detail['report_receiver'] ?></b></div>
        </div>

        <div>၄။</div>

        <table>
            <thead>
                <tr>
                    <th rowspan="2">Position</th>
                    <th rowspan="2">Skill</th>
                    <th colspan="2">Require Worker Count</th>
                    <th rowspan="2">Qualification</th>
                    <th rowspan="2">Position</th>
                    <th rowspan="2">Salary</th>
                </tr>
                <tr>
                    <th>Male</th>
                    <th>Female</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach (json_decode($detail['occupation'], true) as $d):
                    ?>
                    <tr>
                        <td><?= $d['occupation'] ?></td>
                        <td><?= $d['qualification'] ?></td>
                        <td><?= $d['male'] ?></td>
                        <td><?= $d['female'] ?></td>
                        <td><?= $d['qualification'] ?></td>
                        <td><?= $d['working_type_period'] ?? '-' ?></td>
                        <td><?= $d['salary'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div>Letter No <?= $d['letter_no'] ?? '' ?></div>
        <div><?= $formatted_date ?></div>

        <div id="signature">
            <div>

                <img src="sign.jpg" alt="Sign" height="80">
                <br>လက်မှတ်<br>Position Badge
            </div>
        </div>

        <div class="to">
            <pre>
To
Director
______Township
            </pre>
        </div>
    </div>
</div>

<script>
    document.getElementById('printButton').addEventListener('click', function () {

        const printableContent = document.querySelector('.printable-form').innerHTML;

        const printWindow = window.open('', '', 'height=600,width=800');

        printWindow.document.write('<html><head><title>Print Form</title>');
        const styles = document.querySelectorAll('style');
        styles.forEach(style => {
            printWindow.document.write(style.outerHTML);
        });
        printWindow.document.write('</head><body>');
        printWindow.document.write(printableContent);
        printWindow.document.write('</body></html>');

        printWindow.document.close();
        printWindow.focus();
        printWindow.print();

        printWindow.close();
    });
</script>