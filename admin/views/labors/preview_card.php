<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$serial_number = $_GET['sn'] ?? die("Sorry we need specific Serial Number");
require_once __DIR__ . '/../../../commons/Connection.php';

$connection = new Connection();
$connection = $connection::$connection;

$lprepare = $connection->prepare("SELECT * FROM applications WHERE serial_number = ? AND user_id = ?");
$lprepare->bind_param('si', $serial_number, $_GET['uid']);
$lprepare->execute();
$lprepare = $lprepare->get_result();
$laborer = $lprepare->fetch_assoc();
?>

<div class="print-button-container">
    <button onclick="downloadCardAsPdf()">Download Card</button>
    <button onclick="window.print()">Print Card</button>
</div>

<div class="card-container">
    <div class="labor-card-content">
        <div class="details-section">
            <div class="header">
                <div>အလလခ(ပုံစံ ၂)</div>
                <div>အမှတ်စဉ် <?= $laborer['serial_number'] ?></div>
            </div>

            <div class="government-info">
                <span class="country">ပြည်ထောင်စုသမ္မတမြန်မာနိုင်ငံတော်အစိုးရ</span>
                <span>အလုပ်သမားညွှန်ကြားရေးဦးစီးဌာန</span>
                <span>အလုပ်အကိုင်နှင့်အလုပ်သမားရှာဖွေရေးရုံး</span>
            </div>

            <h1 class="card-title">အလုပ်သမားမှတ်ပုံတင်ကတ်ပြား</h1>

            <div class="personal-details">
                <div class="detail-item">
                    <span class="label">အမည်:</span>
                    <span class="value"><?= $laborer['name'] ?></span>
                </div>
                <div class="detail-item">
                    <span class="label">အဘ အမည်:</span>
                    <span class="value"><?= $laborer['fatherName'] ?></span>
                </div>
                <div class="detail-item">
                    <span class="label">မှတ်ပုံတင်အမှတ်:</span>
                    <span class="value"><?= $laborer['nrc'] ?></span>
                </div>
                <div class="detail-item">
                    <span class="label">နေရပ်လိပ်စာ:</span>
                    <span class="value"><?= $laborer['stable_address'] ?></span>
                </div>
                <div class="detail-item">
                    <span class="label">အသိအမှတ်ပြုရက်စွဲ:</span>
                    <span class="value"><?php echo (new DateTime())->format("Y-m-d"); ?></span>
                </div>
            </div>

            <div class="signature-section">
                <div class="f-box">
                    <span>လက်ဝဲလက်မ</span>
                </div>
                <div class="signature-box">
                    <img src="/labor_application/importants/director_sign.png" alt="Director Signature"
                        class="signature-img">
                    <p>ရုံးတာဝန်ခံ</p>
                </div>
                <img src="/labor_application/importants/stamp_.png" alt="Stamp" class="stamp-img">
            </div>
        </div>

        <div class="rules-section">
            <h2 class="rules-title">မှတ်ချက်</h2>
            <p>
                အလုပ်အကိုင်နှင့် စပ်လျဉ်း၍ ဦးစီးအရာရှိနှင့် လာရောက်တိုင်ပင်သည့်အခါတွင် ဤလက်မှတ် ယူခဲ့ရမည်။
                အကယ်၍ အလုပ်အကိုင်ရရှိခဲ့သော် အလုပ်အကိုင်နှင့် အလုပ်သမားရှာဖွေရေးရုံးသို့
                အလုပ်သမားမှတ်ပုံတင်ကတ်ပြား၏အမှတ်စဉ် ကိုဖော်ပြ၍ အကြောင်းကြားရမည်။
            </p>
            <p>
                ဤလက်မှတ်ကို (တစ်နှစ်) တစ်ကြိမ် လဲလှယ် ရမည်။ မိမိကိုယ်တိုင်လာရောက်ရန် အခက်အခဲ ရှိပါက
                စာဖြင့်ဖြစ်စေ၊လူလွှတ်၍ဖြစ်စေ လဲလှယ် နိုင်သည်။
            </p>
        </div>
    </div>
    <hr>
    <div class="card-back">
        <div>
            <p>အလုပ်သမားမှတ်ပုံတင်ကတ်ပြားသက်တမ်းတိုးမှုဇယား</p>
            <p>အလုပ်သမားမှတ်ပုံတင်ကတ်ပြားသက်တမ်းတိုးမှုဇယား</p>
        </div>
        <div>
            <?php
            for ($i = 0; $i < 2; $i++):
                ?>
                <table>
                    <thead>
                        <tr>
                            <th>စဉ်</th>
                            <th>သက်တမ်းတိုးသည့်ရက်စွဲ</th>
                            <th>ရုံးတာဝန်ခံလက်မှတ်</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($j = 0; $j < 7; $j++):
                            ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            <?php endfor; ?>
        </div>
        <img src="/labor_application/importants/stamp_.png" alt="Stamp" class="stamp">
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>

    async function downloadCardAsPdf() {
        const { jsPDF } = window.jspdf;
        const pdf = new jsPDF('p', 'mm', 'a4');

        const imgWidth = 190;
        let position = 10;
        const front = document.querySelector(".labor-card-content");
        const frontCanvas = await html2canvas(front, { scale: 2 });
        const frontImgData = frontCanvas.toDataURL('image/png');
        const frontImgHeight = frontCanvas.height * imgWidth / frontCanvas.width;

        pdf.addImage(frontImgData, 'PNG', 10, position, imgWidth, frontImgHeight);
        const back = document.querySelector(".card-back");
        const backCanvas = await html2canvas(back, { scale: 2 });
        const backImgData = backCanvas.toDataURL('image/png');
        const backImgHeight = backCanvas.height * imgWidth / backCanvas.width;

        pdf.addPage();
        pdf.addImage(backImgData, 'PNG', 10, position, imgWidth, backImgHeight);

        pdf.save("labor_card_<?= $laborer['serial_number'] ?>.pdf");
    }


</script>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background-color: #f0f2f5;
        color: #333;
    }

    .print-button-container {
        text-align: center;
        margin-bottom: 20px;
    }

    .print-button-container button {
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .print-button-container button:hover {
        background-color: #0056b3;
    }


    .card-container {
        width: 800px;
        margin: 0 auto;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .labor-card-content {
        display: flex;
        flex-direction: row-reverse;
        justify-content: space-between;
        gap: 30px;
    }

    .details-section {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .details-section .header {
        display: flex;
        justify-content: space-between;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .government-info {
        text-align: center;
        line-height: 1.5;
        margin-bottom: 20px;
    }

    .government-info .country {
        font-size: 1.2em;
        font-weight: bold;
    }

    .card-title {
        text-align: center;
        font-size: 1.4em;
        text-decoration: underline;
        margin-bottom: 20px;
    }

    .personal-details .detail-item {
        display: flex;
        margin-bottom: 10px;
    }

    .personal-details .label {
        font-weight: bold;
        width: 150px;
    }

    .personal-details .value {
        flex: 1;
        border-bottom: 1px dotted #ccc;
        padding-bottom: 2px;
    }


    .signature-section {
        position: relative;
        margin-top: 30px;
        display: flex;
        justify-content: center;
        align-items: flex-end;
    }

    .signature-box {
        text-align: center;
    }

    .signature-img {
        width: 150px;
        height: auto;
    }

    .stamp-img {
        position: absolute;
        width: 200px;
        height: auto;
        opacity: 0.7;
        top: -400px;
        left: 0px;
    }


    .rules-section {
        width: 300px;
        /* background-color: #f9f9f9; */
        padding: 20px;
        border-left: 1px solid #eee;
        font-size: 0.9em;
        line-height: 1.6;
        text-align: justify;
    }

    .rules-section p {
        margin-bottom: 15px;
    }

    .rules-title {
        text-align: center;
        margin-bottom: 15px;
    }

    .f-box {
        position: relative;
        top: -50px;
        left: -20px;
        height: 100px;
        width: 100px;
        border: 2px solid black;
        display: flex;
        flex-direction: column;
        justify-content: end;
    }

    .f-box span {
        display: block;
        text-align: center;
    }

    .card-back table {
        border-collapse: collapse;
    }

    .card-back div {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }

    .card-back th,
    td {
        border: 2px solid black;
        padding: 10px;
    }

    .card-back td {
        padding: 20px 0;
    }

    .card-back .stamp {
        position: absolute;
        top: 800px;
        left: 550px;
        width: 200px;

    }

    @media print {
        body {
            margin: 0;
            padding: 40px;
            background-color: white;

        }

        .print-button-container {
            display: none;
        }

        .card-container {
            width: 100%;
            box-shadow: none;
            border-radius: 0;
            padding: 40px;
        }

        .labor-card-content {
            page-break-inside: avoid;
        }

        .stamp-img {
            position: absolute;
            width: 200px;
            height: auto;
            opacity: 0.7;
            top: -400px;
            left: 0px;
        }

        .card-back .stamp {
            position: absolute;
            top: 800px;
            left: 550px;
            width: 200px;
            height: auto;
            opacity: 0.7;

        }
    }
</style>