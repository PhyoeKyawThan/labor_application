<?php
$detail = $reqModel->readDetails($_GET['fid']);
?>
<div id="form-container" class="form-container">
    <div class="header">
        <div>Form 1</div>
        <div>Ah Kaung Kyar Sar</div>
    </div>

    <div class="details">
        <div>၁။ name/position/address  <b><?= $detail['name'] .' ၊ '.$detail['position'],' ၊ '.$detail['department_address']  ?></b></div>
        <div>၂။ phone  <b><?= $detail['phone'] ?></b></div>
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
                foreach(json_decode($detail['occupation'], true) as $d):
            ?>
            <tr>
                <td><?= $d['occupation'] ?></td>
                <td><?= $d['occupation'] ?></td>
                <td><?= $d['male'] ?></td>
                <td><?= $d['female'] ?></td>
                <td><?= $d['qualification'] ?></td>
                <td><?= $d['position'] ?></td>
                <td><?= $d['salary'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div>Letter No. ......</div>
    <div>၂၀၂၅ ခုနှစ်၊ ဖေဖော် လ၊ ၂၀ ရက်</div>

    <div id="signature">
        <div>
            <img src="sign.jpg" alt="Sign" height="80">
            <br>လက်မှတ်<br>Position Badge
        </div>
    </div>
</div>

<style>

    .form-container {
        padding: 20mm;
        background: white;
        width: 210mm;
        min-height: 297mm;
        box-sizing: border-box;
        margin: auto;
        box-shadow: 0 0 10px gray;
    }

    .header {
        text-align: center;
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .details {
        margin-bottom: 15px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 15px;
    }

    th, td {
        border: 1px solid black;
        padding: 6px;
        text-align: center;
    }

    #signature {
        margin-top: 40px;
        text-align: right;
    }

    #signature img {
        display: block;
        margin-bottom: 5px;
    }

    /* Print Styles */
    @media print {
        body {
            margin: 0;
        }

        .form-container {
            page-break-after: always;
        }

        @page {
            size: A4;
            margin: 20mm;
        }

        #signature {
            page-break-inside: avoid;
        }

        .no-print {
            display: none;
        }
    }
</style>
