<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once __DIR__ . '/ReportDataGenerator.php';
require_once __DIR__ . '/../../../commons/DateConverter.php';

$report = new ReportDataGenerator();

?>
<div id="report-filter">
    <form action="" method="post">
        <label for="date">Filter Date <i class="fas fa-filter"></i></label>

        <label for="month">Select Month & Year:</label>
        <div class="month-year-group">
            <?php
            $months = [
                "01" => "January",
                "02" => "February",
                "03" => "March",
                "04" => "April",
                "05" => "May",
                "06" => "June",
                "07" => "July",
                "08" => "August",
                "09" => "September",
                "10" => "October",
                "11" => "November",
                "12" => "December"
            ];
            ?>
            <select name="month" id="month" required>
                <option value="">Month</option>
                <?php foreach ($months as $num => $name): ?>
                    <option value="<?= $num ?>" <?= (isset($_POST['month']) && $_POST['month'] === $num) ? 'selected' : '' ?>>
                        <?= $name ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <select name="year" id="year" required>
                <option value="">Year</option>
                <?php
                $currentYear = date("Y");
                for ($y = $currentYear; $y >= 2000; $y--) {
                    $selected = isset($_POST['year']) && $_POST['year'] == $y ? 'selected' : '';
                    echo "<option value='$y' $selected>$y</option>";
                }
                ?>
            </select>
        </div>

        <label for="report_type">Report Type:</label>
        <select name="report_type" id="report_type">
            <option value="1" <?= isset($_POST['report_type']) && $_POST['report_type'] == 1 ? 'selected' : '' ?>>အလုပ်ရရှိသူများ၏ အသက်အပိုင်းအခြားအလိုက် ဖော်ပြသည့်စာရင်း</option>
            <option value="2" <?= isset($_POST['report_type']) && $_POST['report_type'] == 2 ? 'selected' : '' ?>>အသစ်မှတ်ပုံတင်သူများကို အသက်အားဖြင့် ပြသည့်စာရင်း</option>
            <option value="3" <?= isset($_POST['report_type']) && $_POST['report_type'] == 3 ? 'selected' : '' ?>>အသစ်မှတ်ပုံတင်သူများကို ပညာအရည်အချင်းဖြင့်ပြသည့်ဇယား</option>
            <option value="4" <?= isset($_POST['report_type']) && $_POST['report_type'] == 4 ? 'selected' : '' ?>>ဌာနအလိုက် အလုပ်ရရှိသူများစာရင်း</option>
        </select>

        <input type="submit" value="Search">

    </form>

    <?php
    if (isset($_POST['month']) && isset($_POST['year']) && isset($_POST['report_type'])) {
        $report->months = (int) $_POST['month'];
        $report->year = (int) $_POST['year'];
        $date = engToBurmeseNumber($_POST['month']) . '/' . engToBurmeseNumber($_POST['year']);
        echo '<div style="text-align: right;"><button id="download-pdf" style="
    padding: 8px 15px;
    background-color: #007bff;
    color: #fff;
    border: none;
    margin: 20px 0 0 0;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
">
            <i class="fas fa-file-pdf"></i> Download PDF
        </button></div>
';
        switch ((int) $_POST['report_type']) {
            case 1:
                require __DIR__ . '/forms/report_1.php';
                break;
            case 2:
                require __DIR__ . '/forms/report_2.php';
                break;
            case 3:
                require __DIR__ . '/forms/report_3.php';
                break;
            case 4:
                require __DIR__ . '/forms/report_4.php';
                break;
        }
    }

    ?>
</div>
<script>
    document.getElementById('download-pdf').addEventListener('click', () => {
        const { jsPDF } = window.jspdf;

        const report = document.getElementById('print-container');

        html2canvas(report, { scale: 2 }).then(canvas => {
            const imgData = canvas.toDataURL('image/png');
            const pdf = new jsPDF({
                orientation: 'portrait',
                unit: 'mm',
                format: 'a4'
            });

            const imgProps = pdf.getImageProperties(imgData);
            const pdfWidth = pdf.internal.pageSize.getWidth();
            const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

            pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
            pdf.save('Employed_Labors_Report.pdf');
        });
    });
</script>

<style>
    #report-filter {
        margin: 20px auto;
        padding: 20px;
        border: 2px solid #ddd;
        border-radius: 8px;
        background: #f9f9f9;
        /* max-width: 700px; */
        font-family: "Pyidaungsu", "Noto Sans Myanmar", sans-serif;
    }

    #report-filter form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    #report-filter label {
        font-weight: bold;
        margin-bottom: 5px;
        display: block;
        color: #333;
    }

    #report-filter select,
    #report-filter input[type="submit"] {
        padding: 8px 12px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 5px;
        width: fit-content;
        min-width: 150px;
    }

    #report-filter select:focus,
    #report-filter input[type="submit"]:focus {
        border-color: #007bff;
        outline: none;
    }

    #report-filter input[type="submit"] {
        background: #007bff;
        color: white;
        border: none;
        cursor: pointer;
        align-self: flex-start;
        transition: background 0.3s;
    }

    #report-filter input[type="submit"]:hover {
        background: #0056b3;
    }

    #report-filter .month-year-group {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    #print-container {
        width: 100%;
        margin: 20px auto;
        padding: 20px;
        border-radius: 8px;
        font-family: "Pyidaungsu", "Noto Sans Myanmar", sans-serif;
        background: #fff;
    }

    #print-container h3 {
        text-align: center;
        margin-bottom: 20px;
        font-size: 18px;
        line-height: 1.6;
    }

    #print-container table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    #print-container table,
    #print-container th,
    #print-container td {
        border: 1px solid black;
    }

    #print-container th,
    #print-container td {
        padding: 8px;
        text-align: center;
        font-size: 14px;
    }

    #print-container th {
        background-color: #f2f2f2;
    }

    @media print {
        body * {
            visibility: hidden;
        }

        #report-filter {
            display: none !important;
        }

        #print-container,
        #print-container * {
            visibility: visible;
        }

        #print-container {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            border: none;
        }
    }
</style>