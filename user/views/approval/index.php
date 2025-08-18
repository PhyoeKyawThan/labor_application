<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
if (!isset($_SESSION['app_id']) && !isset($_SESSION['user_id'])) {
    die("Require information");
}

$form_id = $_SESSION['app_id'];
$user_id = $_SESSION['user_id'];

require __DIR__ . '/../../../admin/views/employer/EmployeeReqForm.php';
require __DIR__ . '/../../../commons/DateConverter.php';
$reqModel = new EmployeeReqForm();

$detail = $reqModel->readDetails($form_id);
$occupation = json_decode($detail['occupation'], true)[0];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($reqModel->saveConfirmDataFromEmployer($form_id, 'Confirmed', $_POST['sign'], $_POST['stamp'])) {
        echo "<script>window.close()</script>";
        exit;
    }
}
?><!DOCTYPE html>
<html lang="my">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Myanmar:wght@400;700&display=swap');

        .a4-container {
            margin: 20px auto;
            width: 210mm;
            min-height: 297mm;
            /* Use min-height for pages with variable content */
            padding: 20mm;
            box-sizing: border-box;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
            font-size: 14px;
            color: #333;
        }

        .header {
            text-align: right;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .header .office-name {
            font-weight: bold;
            font-size: 16px;
        }

        .header .address {
            margin-top: 5px;
        }

        .header .doc-number {
            display: flex;
            justify-content: flex-end;
            align-items: baseline;
            margin-top: 5px;
        }

        .header .doc-number .label {
            margin-right: 5px;
        }

        .to-section {
            margin-top: 50px;
            margin-bottom: 30px;
        }

        .to-section .to-label {
            text-align: left;
            margin-bottom: 5px;
        }

        .to-section .to-line {
            width: 50%;
            margin-left: 50px;
        }

        .main-body {
            line-height: 2;
            /* text-indent: 50px; */
        }

        .main-body p {
            margin: 0;
            padding: 0;
        }

        .signature-section {
            margin-top: 50px;
            text-align: right;
        }

        .signature-section .sign-label {
            margin-bottom: 50px;
            font-weight: bold;
        }

        .a4-container.employees {
            margin-top: 20px;
            padding: 10mm;
        }

        .employees table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .employees table th,
        .employees table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        .employees table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }


        .controls-container {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .controls-container a {
            display: block;
        }

        .controls-container button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            margin-left: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .controls-container button:hover {
            background-color: #0056b3;
        }

        form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 600px;
            margin-bottom: 20px;
            display: none;
            flex-direction: column;
            gap: 20px;
            margin: auto;
        }

        label {
            font-weight: 600;
            color: #333;
            font-size: 1em;
            margin-bottom: 5px;
            display: block;
        }

        input[type="file"],
        input[type="text"],
        input[type="hidden"] {
            display: block;
        }

        input[type="file"] {
            border: 2px dashed #e2e8f0;
            padding: 15px;
            border-radius: 8px;
            background-color: #fafafa;
            cursor: pointer;
            transition: background-color 0.3s, border-color 0.3s;
        }

        input[type="file"]:hover {
            background-color: #f7fafc;
            border-color: #a0aec0;
        }

        #preview-image {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 5px;
            margin-top: 10px;
        }

        #sign-pad-container {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
            margin-top: 10px;
            background-color: #fff;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        canvas#signature {
            /* width: 100%;
            height: 200px;
            border: none; */
            cursor: crosshair;
            margin: auto;
        }

        .buttons {
            display: flex;
            justify-content: flex-start;
            gap: 10px;
            margin-top: 15px;
        }

        .buttons button,
        form button[type="submit"] {
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.1s;
            text-transform: uppercase;
        }

        .buttons button {
            font-size: 0.9em;
        }

        .buttons button:active,
        form button[type="submit"]:active {
            transform: translateY(1px);
        }

        #clear-sign-btn {
            background-color: #ef4444;
            color: white;
        }

        #clear-sign-btn:hover {
            background-color: #dc2626;
        }

        #save-sign-btn {
            background-color: #10b981;
            color: white;
        }

        #save-sign-btn:hover {
            background-color: #059669;
        }

        form button[type="submit"] {
            background-color: #3b82f6;
            color: white;
            width: 100%;
            margin-top: 20px;
        }

        form button[type="submit"]:hover {
            background-color: #2563eb;
        }

        .controls-container,
        .nav-buttons-container {
            width: 100%;
            max-width: 600px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }


        @media print {
            body {
                background-color: white;
            }

            .controls-container {
                display: none;
            }

            .a4-container {
                box-shadow: none;
                border: none;
                margin: 0;
                padding: 15mm;
            }

            .a4-container.employees {
                page-break-before: always;
            }
        }
    </style>
</head>

<body>

    <div
        style="display: flex; align-items: center; justify-content: space-between; background-color: #f3f4f6; padding: 1rem 1.5rem; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 1rem;">

        <a onclick="window.close()"
            style="text-decoration: none; color: #3b82f6; font-weight: 600; display: flex; align-items: center; gap: 5px; cursor: pointer;">
            <i class="fas fa-arrow-left"></i> Back
        </a>

        <h2 style="margin: 0; font-size: 1.5rem; color: #111827;">Confirmation</h2>

        <div style="display: flex; gap: 10px; align-items: center;" class="buttons">
            <!-- ?confirm=true -->
            <button onclick="toggleForm()">Confirm</button>
            <button onclick="downloadTwoPagePdf()"
                style="background-color: #3b82f6; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; font-weight: 600;">
                View as PDF
            </button>
        </div>
    </div>

    <form action="" method="post">
        <input type="hidden" name="comfirm" value="true">
        <label for="image-upload">တံဆိပ်ခေါင်း</label>
        <input type="file" name="stamp_image" id="image-upload" accept="image/*">
        <input type="hidden" name="stamp" id="base64-output">
        <img id="preview-image" src="" alt="Image Preview" style="display:none; max-width: 200px; margin-top: 10px;">
        <br>
        <label for="signature">လက်မှတ်ထိုးရန်</label>
        <label for="sign">ထိုးမြဲလက်မှတ်</label>
        <div id="sign-pad-container">
            <canvas id="signature" width="400" height="200" style="background-color: white-smoke;"></canvas>
        </div>
        <input type="hidden" name="sign" id="sign" required>
        <div class="buttons">
            <button type="button" onclick="clearSign()" style="background-color: var(--ssir-red)" id="">Clear</button>
            <button type="button" onclick="saveSign(event)" style="background-color: var(--ssir-green)"
                id="save-sign">Done</button>
        </div>
        <button type="submit">Submit Form</button>
    </form>

    <script>
        const fileInput = document.getElementById('image-upload');
        const base64Output = document.getElementById('base64-output');
        const previewImage = document.getElementById('preview-image');

        fileInput.addEventListener('change', function (event) {
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    const base64DataUrl = e.target.result;


                    base64Output.value = base64DataUrl;

                    previewImage.src = base64DataUrl;
                    previewImage.style.display = 'block';

                    console.log("Base64 Data URL:", base64DataUrl);
                };

                reader.readAsDataURL(file);
            } else {
                base64Output.value = '';
                previewImage.src = '';
                previewImage.style.display = 'none';
            }
        });

        const canvas = document.getElementById('signature');
        const signaturePad = new SignaturePad(canvas, {
            backgroundColor: 'rgba(0, 0, 0, 0)', // transparent
        });

        function clearSign() {
            signaturePad.clear();
            const save_btn = document.getElementById('save-sign');
            save_btn.innerText = "Done";
            save_btn.disabled = false;
        }

        function saveSign(e) {
            if (!signaturePad.isEmpty()) {
                const dataURL = signaturePad.toDataURL("image/png");
                document.getElementById('sign').value = dataURL;
                e.target.innerText = "Saved";
                e.target.disabled = true;
                console.log("click")
            } else {
                alert("Please draw your signature first.");
            }
        }

        function toggleForm() {
            const form = document.querySelector("form");
            if (form.style.display == 'flex') {
                form.style.display = 'none';
            } else {
                form.style.display = 'flex';
            }
        }
    </script>

    <!-- First Page -->
    <div class="a4-container">
        <div class="header">
            <div class="office-name">
                အလုပ်သမားညွှန်ကြားရေးဦးစီးဌာန(ရုံးချုပ်)
            </div>
            <div class="address">
                ဗဟိုရုံး
            </div>
            <div class="address">
                နေပြည်တော်
            </div>
            <div class="address">
                စာအမှတ်၊ ၈/၂/အလည-မ(အလခ)( )
            </div>
            <div class="doc-number">
                <span class="label">ရက်စွဲ:</span>
                <b><?php
                $curr = new DateTime();
                echo formatMyanmarDate($curr->format('Y-m-d'));
                ?> </b>
            </div>
        </div>

        <div class="to-section">
            <div class="to-label">
                သို့
            </div>
            <div class="to-line">
                <?= $detail['toDeliver'] ?>
            </div>
        </div>

        <div class="main-body">
            <p>
                <span class="to-label">အကြောင်းအရာ။&nbsp;&nbsp;</span> <b>အလလခ ပုံစံ(၆) စာရင်းပေးပို့ခြင်း</b>
            </p>
            <p>
                <span class="to-label">ရည်ညွှန်းချက်။&nbsp;&nbsp;</span>
                <span><?= $detail['name'] ?> ဌာန၏ <?= formatMyanmarDate($detail['submitted_at']) ?> ရက်စွဲပါ စာအမှတ်၊
                    ပေးပို့သည့်အမှာစာ
                </span>
            </p>

            <p>
                ၁။ အထက်ပါကိစ္စနှင့်ပတ်သက်၍ရည်ညွှန်းပါစာဖြင့်အကြောင်းကြားချက်အရ <?= $detail['name'] ?> ဌာနတွင်
                လစ်လပ်‌လျှက်ရှိသော
                <?= $occupation['occupation'] ?> ရာထူး နေရာအတွက် အလုပ်လုပ်ကိုင် သူများစာရင်း အလလခပုံစံ(၆) (၂)နှစ်စုံအား
                ရွေးချယ်နိုင်ပါရန်
                ပူးတွဲပေးပို့အပ်ပါသည်။
            </p>

            <p>
                ၂။ သို့ဖြစ်ပါ၍ သက်ဆိုင်ရာ
            </p>
        </div>

        <div class="signature-section">
            <div class="sign-label">
                ဦးစီးမှူး
            </div>
            <p>ရုံးတာဝန်ခံ</p>
        </div>
    </div>

    <br>

    <?php
    $employees = $reqModel->readEmployeeDetails($form_id);
    ?>
    <div class="a4-container employees">
        <span><b>အလုပ်သမားညွှန်ကြားရေးဦးစီးဌာန(ရုံးချုပ်)</b></span>
        <br>
        <span><b>အလလခ ပုံစံ (၆)</b></span>
        <br>
        <span style="font-size: 19px;"><b>အလုပ်သမားအင်အားစာရင်း</b></span>
        <br>
        <span>
            အလုပ်သမားအင်အားတောင်းခံသည့်ဌာန: <?= $detail['name'] ?>
        </span>
        <table>
            <thead>
                <tr>
                    <th>အမှတ်</th>
                    <th>အမည်</th>
                    <th>အသက်</th>
                    <th>အဘအမည်</th>
                    <th>ရာထူးကုဒ်</th>
                    <th>ကတ်အမှတ်</th>
                    <th>မှတ်ပုံတင်ရက်စွဲ</th>
                    <th>နေရပ်လိပ်စာ</th>
                    <th>ပညာအရည်အချင်း</th>
                    <th>မှတ်ချက်</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $position_codes = require_once __DIR__ . '/../../../commons/position_codes.php';
                $e_codes = $position_codes['employee_codes'];
                foreach ($employees as $index => $e):
                    $reg_date = new DateTime($e['registration_date']);
                    $reg_date_components = getMyanmarDateComponents($reg_date->format('Y-m-d'));
                    ?>
                    <tr>
                        <td><?= ++$index ?></td>
                        <td><?= $e['name'] ?></td>
                        <td><?= $e['age'] ?></td>
                        <td><?= $e['fatherName'] ?></td>
                        <td><?= $e_codes[$occupation['occupation']] ?? 'N/A' ?></td>
                        <td><?= $e['serial_number'] ?></td>
                        <td><?= $reg_date_components['day'] . '/' . $reg_date_components['month'] . '/' . $reg_date_components['year'] ?>
                        </td>
                        <td><?= $e['stable_address'] ?></td>
                        <td><?= $e['edu_level'] ?></td>
                        <td></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
    <script>
        window.jsPDF = window.jspdf.jsPDF;

        function downloadTwoPagePdf() {
            const pages = document.querySelectorAll('.a4-container');
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF('p', 'mm', 'a4');
            const totalPages = pages.length;

            let currentPage = 0;

            const processPage = (pageElement) => {
                return new Promise(resolve => {
                    html2canvas(pageElement, { scale: 2 }).then(canvas => {
                        const imgData = canvas.toDataURL('image/png');
                        const imgWidth = 210;
                        const pageHeight = 297;
                        const imgHeight = canvas.height * imgWidth / canvas.width;

                        const margin = 10;
                        const contentWidth = imgWidth - (2 * margin);
                        const contentHeight = imgHeight - (2 * margin);

                        pdf.addImage(imgData, 'PNG', margin, margin, contentWidth, contentHeight);

                        currentPage++;
                        if (currentPage < totalPages) {
                            pdf.addPage();
                        }
                        resolve();
                    });
                });
            };
            let promise = Promise.resolve();
            pages.forEach(page => {
                promise = promise.then(() => processPage(page));
            });

            promise.then(() => {
                pdf.save("burmese_form.pdf");
            });
        }
    </script>
</body>

</html>