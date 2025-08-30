
<?php 
require_once __DIR__.'/../../../admin/views/employer/EmployeeReqForm.php';
require_once __DIR__.'/../../../commons/DateConverter.php';
$reqModel = new EmployeeReqForm();
$detail = $reqModel->readDetailsByUserId($_GET['fid'], $_SESSION['user_id'] ?? die("Require logged in"));
$formatted_date = formatMyanmarDate($detail['submitted_at']);
?>
<div class="printable-form">
    <div id="form-container" class="form-container">
        <div class="header">
            <!-- <div>Form 1</div> -->
            <div>အလုပ်သမားလိုကြောင်း အကြောင်းကြားစာ</div>
        </div>

        <div class="details">
            <div>၁။ အလုပ်ရှင်၏ အမည်/ရာထူး/ဌာနလိပ်စာ
                <b><?= $detail['name'] . ' ၊ ' . $detail['position'] . ' ၊ ' . $detail['department_address'] ?></b>
            </div>
            <div>၂။ ဖုန်းနံပါတ် <b><?= $detail['phone'] ?></b></div>
            <div>၃။ အလုပ်သမား သွားရောက် အစီရင်ခံရန် အစီရင်ခံရမည့် ပုဂ္ဂိုလ်၏အမည်နှင့်ရာထူး
                <b><?= $detail['report_receiver_name'] . '(' . $detail['report_receiver_position'] . ')' ?></b>
            </div>
            <div>၄။ အစီရင်ခံမည့် နေရာနှင့်အချိန်
                <span>
                    <?= $detail['report_receiver_address'] ?>
                    <br><?= $detail['report_receiver_time'] ?>
                </span>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th rowspan="2">အလုပ်အကိုင်</th>
                    <th rowspan="2">ကျွမ်းကျင်မှုအဆင့်အတန်း (သို့) အတန်းစား</th>
                    <th colspan="2">လိုအပ်သော အလုပ်သမားဦးရေ</th>
                    <th rowspan="2">အလုပ်ကိုင်အမျိုးအစားနှင့် လိုအပ်သော အရည်အချင်း</th>
                    <th rowspan="2">အလုပ်လုပ်ကိုင်ရမည့် ကာလအပိုင်းအခြားနှင့် နေရာဒေသ</th>
                    <th rowspan="2">လစာနှုန်းနှင့် အလုပ်ချိန်</th>
                </tr>
                <tr>
                    <th>ကျား</th>
                    <th>မ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach (json_decode($detail['occupation'], true) as $d):
                    ?>
                    <tr>
                        <td><?= $d['occupation'] ?></td>
                        <td><?= $d['skill'] ?></td>
                        <td><?= $d['male'] ?></td>
                        <td><?= $d['female'] ?></td>
                        <td><?= $d['qualification'] ?></td>
                        <td><?= $d['working_type_period'] ?? '-' ?></td>
                        <td><?= $d['salary'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div>စာအမှတ် <?= $detail['letter_no'] ?? '' ?></div>
        <div><?= $formatted_date ?></div>

        <div id="signature">
            <div style="text-align: center">
                <img src="<?= $detail['signature'] ?>" alt="Sign" height="80">
                <br>လက်မှတ်<br>ရာထူးတံဆိပ်
            </div>
        </div>

        <div id="stamp">
            <div>
                <img src="/labor_application/importants/stamp_.png" alt="" srcset="">
            </div>
        </div>

        <div class="to">
            <pre>
သို့

    မြို့နယ်ဦးစီးဌာနမှူး
    အလုပ်သမားညွှန်ကြားရေးဦးစီးဌာန(မြို့နယ်ရုံး)
    ဟင်္သာတမြို့
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

<style>

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


    /* .printable-form {
        display: none;
    } */

    .form-container {
        width: 210mm;
        min-height: 297mm;
        padding: 25mm;
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
    #stamp{
        position: absolute;
        top: 200px;
        left: 300px;
    }
    #stamp img{
        width: 150px;
        height: auto;
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