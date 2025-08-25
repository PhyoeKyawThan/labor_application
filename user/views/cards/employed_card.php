<?php
session_start();
$form_id = $_SESSION['app_id'] ?? $_GET['app_id'] ?? die("Information Invalid");
$user_id = $_SESSION['user_id'] ?? $_GET['uid'] ?? die("Information Invalid");

require __DIR__ . '/../../../admin/views/employer/EmployeeReqForm.php';
require __DIR__ . '/../../../commons/DateConverter.php';
$reqModel = new EmployeeReqForm();
$detail = $reqModel->readDetails($form_id);
$employees = $reqModel->readEmployeeDetails($form_id);
$occupation = json_decode($detail['occupation'], true)[0];
$position_codes = require_once __DIR__ . '/../../../commons/position_codes.php';
$e_codes = $position_codes['employee_codes'];
$date = getMyanmarDateComponents($detail['submitted_at']);
?>
<div class="employed-card-container">
    <?php foreach ($employees as $emp):
        $reg_date = getMyanmarDateComponents($emp['registration_date']);
        $app_date = getMyanmarDateComponents($detail['approval_req_date']);
        ?>
        <div class="flip-card" onclick="this.classList.toggle('flipped')" id="<?= $emp['id'] ?>">
            <div class="flip-card-inner">
                <!-- Front -->
                <div id="employed-card-<?= $emp['nrc'] ?>" class="flip-card-front employed-card">
                    <div class="government-info">
                        <span style="font-weight: bold; float: right;"><?= $emp['approved_serial'] ?></span>
                        <span class="country" style="position: relative; left: 18px;">ပြည်ထောင်စုသမ္မတမြန်မာနိုင်ငံတော်</span>
                        <br>
                        <span>အလုပ်သမားညွှန်ကြားရေးဦးစီးဌာန</span>
                        <span>အလုပ်အကိုင်နှင့်အလုပ်သမားရှာဖွေရေးရုံး</span>
                    </div>
                    <h1 class="card-title">အလုပ်ခန်ထားရေးကတ်ပြား</h1>
                    <p>
                        လူကြီးမင်း၏ <?= $date['day'] . '.' . $date['month'] . '.' . $date['year'] ?>
                        နေ့စွဲပါစာအမှတ် <?= $detail['letter_no'] ?? '-' ?>
                        အရအလုပ်သမားမှတ်ပုံတင်လက်မှတ်၏အမှတ်စဉ် <?= $emp['serial_number'] ?>
                        နေ့စွဲ <?= $reg_date['day'] . '.' . $reg_date['month'] . '.' . $reg_date['year'] ?>
                        အမည် <?= $emp['name'] ?>
                        အဖအမည် <?= $emp['fatherName'] ?>
                        နေရပ် <?= $emp['stable_address'] ?>
                        နိုင်ငံသားစိစစ်ရေးအမှတ် <?= $emp['nrc'] ?>
                        အလုပ်အကိုင် <?= $occupation['occupation'] ?>
                        အလုပ်ညွှန်အမှတ် <?= $e_codes[$occupation['occupation']] ?> အား
                        ရက်နေ့ <?= $app_date['day'] . '.' . $app_date['month'] . '.' . $app_date['year'] ?>
                        အချိန်တွင် ရွေးချယ်လိုက်ပြီးဖြစ်၍ ခန့်ထားရန် လွှတ်လိုက်ပါသည်။ ထိုပုဂ္ဂိုလ်မှန်မမှန်ကို ၎င်း၏
                        နိုင်ငံသားစိစစ်ရေးကတ်ပြားနှင့် တိုက်ဆိုင်၍ စစ်ဆေးရပါမည်။ ခန့်ထားပြီးပါက ဤရုံးသို့
                        အကြောင်းပြန်ကြားရပါမည်။
                    </p>
                    <div class="direction-sign">
                        <img src="/labor_application/importants/director_sign.png" alt="">
                        <!-- <p> ဦးစီးအရာရှိ</p> -->
                    </div>

                    <div class="stamp">
                        <img src="/labor_application/importants/stamp_.png" alt="">
                    </div>
                    <a href="#" class="download-button"
                        onclick="downloadCard('employed-card-<?= $emp['nrc'] ?>'); event.stopPropagation();">Print</a>
                </div>

                <!-- Back -->
                <div class="flip-card-back employed-card">
                    <p>To</p>
                    <p><?= $detail['toDeliver'] ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script>
    function downloadCard(cardId) {
        const cardFront = document.getElementById(cardId);
        const cardParent = cardFront.closest('.flip-card');
        const cardBack = cardParent.querySelector('.flip-card-back');

        const frontClone = cardFront.cloneNode(true);
        const backClone = cardBack.cloneNode(true);

        const downloadButtonFront = frontClone.querySelector('.download-button');
        const downloadButtonBack = backClone.querySelector('.download-button');
        if (downloadButtonFront) downloadButtonFront.remove();
        if (downloadButtonBack) downloadButtonBack.remove();
        const printContainer = document.createElement('div');
        printContainer.className = 'print-container';

        const frontWrapper = document.createElement('div');
        frontWrapper.appendChild(frontClone);

        const backWrapper = document.createElement('div');
        backWrapper.appendChild(backClone);

        printContainer.appendChild(frontWrapper);
        printContainer.appendChild(backWrapper);

        const originalContent = document.querySelector('.employed-card-container');
        originalContent.style.display = 'none';
        document.body.appendChild(printContainer);

        window.print();

        setTimeout(() => {
            document.body.removeChild(printContainer);
            originalContent.style.display = 'flex';
        }, 1000);
    }

</script>
<style>
    body {
        font-family: 'Pyidaungsu', sans-serif;
        background-color: #f4f4f4;
        padding: 20px;
    }

    .employed-card-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }

    .employed-card {
        border: 1px solid #ccc;
        padding: 20px;
        margin-bottom: 20px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
        width: 100%;
        max-width: 600px;
        box-sizing: border-box;
    }

    .government-info {
        text-align: center;
        margin-bottom: 10px;
    }

    .country {
        font-size: 1.2em;
        font-weight: bold;
    }

    .card-title {
        text-align: center;
        font-size: 1.5em;
        margin: 10px 0;
        border-bottom: 2px solid #000;
        padding-bottom: 5px;
    }

    .employed-card p {
        line-height: 1.6;
    }

    .direction-sign,
    .stamp {
        position: absolute;
        bottom: 20px;
        opacity: 0.5;
    }

    .direction-sign img,
    .stamp img {
        width: 100px;
        height: auto;
    }

    .direction-sign {
        right: 20px;
    }

    .stamp {
        top: 100px;
        width: 200px !important;

        left: 20px;
    }

    .download-button {
        display: block;
        width: 200px;
        margin: 20px auto;
        padding: 10px;
        text-align: center;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .flip-card {
        background-color: transparent;
        width: 600px;
        height: 500px;
        perspective: 1000px;
        cursor: pointer;
    }

    .flip-card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        transition: transform 0.8s;
        transform-style: preserve-3d;
    }

    .flip-card.flipped .flip-card-inner {
        transform: rotateY(180deg);
    }

    .flip-card-front,
    .flip-card-back {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
        top: 0;
        left: 0;
        background: #fff;
        border: 1px solid #ccc;
        padding: 20px;
        box-sizing: border-box;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .flip-card-back {
        transform: rotateY(180deg);
    }

    .flip-card.flipped .download-button {
        display: none;
    }



    @media print {
        body {
            background-color: #fff;
        }

        .print-container {
            display: block;
            width: 100%;
        }

        .print-container>div {
            page-break-after: always;
        }

        .flip-card-inner,
        .flip-card-back,
        .flip-card-front {
            margin: auto;
            transform: none !important;
            position: relative !important;
            backface-visibility: visible !important;
            height: 600px !important;
            width: 100% !important;
        }

        .flip-card-back {
            transform: none !important;
        }

        .employed-card {
            max-width: 45%;
            margin: auto;
        }

        .download-button {
            display: none !important;
        }
    }
</style>