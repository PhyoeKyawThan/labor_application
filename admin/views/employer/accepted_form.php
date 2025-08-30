<!DOCTYPE html>
<html lang="my">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
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

        .header-parent {
            display: flex;
            justify-content: end;
        }

        .header {
            width: fit-content;
            text-align: left;
            margin-bottom: 20px;
            margin-right: 0;
            line-height: 1.5;
        }

        .header .office-name {
            /* background-color: red; */
            /* font-weight: bold; */
            text-align: justify;
            font-size: 16px;
        }

        .header .address {
            display: flex;
            justify-content: space-between;
            /* background-color: red; */
            text-align: justify;
            margin-top: 5px;
        }

        .header .doc-number {
            width: fit-content;
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

        .signature-section img {
            width: 150px;
            height: 150px;
        }

        .stamp {
            position: absolute;
            opacity: 0.5;
            top: 20px;
            /* right: 150px; */

        }
        h2,
        h3,
        h4 {
            text-align: center;
            line-height: 1;
        }

        .stamp img {
            width: 200px;
            height: 200px;
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
<?php

if (isset($_GET['correct'])) {
    if ($detail['status'] != 'Finished') {
        $status = $_GET['status'] == 'Confirmed' ? 'Finished' : 'Department Approvel';
        if ($reqModel->changeStatus((int) $_GET['fid'], $status)) {
            $url = $_SERVER['REQUEST_URI'];
            $parts = parse_url($url);
            parse_str($parts['query'] ?? '', $queryParams);
            unset($queryParams['correct']);
            $newQuery = http_build_query($queryParams);
            $red_url = $parts['path'] . ($newQuery ? '?' . $newQuery : '');
            echo "<script> window.location.href = '$red_url'</script>";
            exit;
        }
    }
}
?>

<body>
    <div class="controls-container">
        <a href="<?= parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) . '?vr=employer&fid=' . $_GET['fid'] . '' ?>">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h2>Preview</h2>
        <div display="flex">
            <button style="background-color: green;"
                onclick="window.location.href = '<?= $_SERVER['REQUEST_URI'] ?>&correct=true&status=<?= $detail['status'] ?>'"><i
                    class="fas fa-mark"></i><?= $detail['status'] ?></button>
            <button
                onclick="window.open('/labor_application/user/views/cards/employed_card.php?app_id=<?= $detail['id'] ?>&uid=<?= $detail['uid'] ?>', 'EmployeeCards', 'width=1000,height=700,scrollbars=yes,resizable=yes'); return false;">
                <i class="fas fa-list"></i> Employee cards Preview
            </button>
            <button onclick="downloadTwoPagePdf()">View as Pdf</button>
        </div>
    </div>

    <!-- First Page -->
    <div class="a4-container">
        <div class="header-parent">
            <div class="header">
                <div class="office-name">
                    အလုပ်သမားညွှန်ကြားရေးဦးစီးဌာန
                </div>
                <div class="address" style="">
                    <div>ဟင်္သာတခရိုင်</div>
                    <div>-</div>
                    <div>ဟင်္သာတမြို့</div>
                </div>
                <div class="address">
                    စာအမှတ်၊ ၈/၂/အလည-မ(အလခ)( <?= engToBurmeseNumber($detail['outletter_no']) ?> )
                </div>
                <div class="doc-number">
                    <span class="label">ရက်စွဲ:</span>
                    <?php
                    $curr = new DateTime();
                    echo formatMyanmarDate($curr->format('Y-m-d'));
                    ?> 
                </div>
            </div>
        </div>

        <div class="to-section">
            <div class="to-label">
                သို့
            </div>
            <div class="to-line">
                <?= $to ?>
            </div>
        </div>

        <div class="main-body">
            <p>
                <span class="to-label">အကြောင်းအရာ။&nbsp;&nbsp;</span> <b>အလလခ ပုံစံ(၆) စာရင်းပေးပို့ခြင်း</b>
            </p>
            <p>
                <span class="to-label">ရည်ညွှန်းချက်။&nbsp;&nbsp;</span>
                <span><?= $department ?> ဌာန၏ <?= formatMyanmarDate($date) ?> ရက်စွဲပါ စာအမှတ် <?= $detail['letter_no'] ?>၊
                    ပေးပို့သည့်အမှာစာ
                </span>
            </p>

            <p style="text-align: justify">
                ၁။ အထက်ပါကိစ္စနှင့်ပတ်သက်၍ရည်ညွှန်းပါစာဖြင့်အကြောင်းကြားချက်အရ <?= $detail['department_address'] ?> ဌာနတွင်
                လစ်လပ်‌လျှက်ရှိသော
                <?= $position ?> ရာထူး နေရာအတွက် အလုပ်လုပ်ကိုင် သူများစာရင်း အလလခပုံစံ(၆) (၂)နှစ်စုံအား
                ရွေးချယ်နိုင်ပါရန်
                ပူးတွဲပေးပို့အပ်ပါသည်။
            </p>

            <p style="text-align: justify">
                ၂။ သို့ဖြစ်ပါ၍ သက်ဆိုင်ရာဌာနမှ ခန့်ထားပြီးကြောင်း ခွင့်ပြုချက်ရရှိပါက အလုပ်ခန့်ထားရေး ကတ်ပြား အလလခ ပုံစံ(၇) ကိုထုတ်ပေးသွားမည်ဖြစ်ပါကြောင်းအကြောင်းကြားအပ်ပါသည်
            </p>
        </div>

        <div class="signature-section" style="text-align: center; float: right;">
            <img src="<?= $detail['department_confirm_sign'] ?? '/labor_application/importants/director_sign.png' ?>" alt="" srcset="">
            <div class="sign-label">
                ဦးစီးမှူး
            </div>
            <p></p>
        </div>
        <div class="stamp">
            <img src="<?= $detail['department_confirm_stamp'] ?? '/labor_application/importants/stamp_.png' ?>" alt=""
                srcset="">
        </div>
    </div>

    <br>

    <?php
    $employees = $reqModel->readEmployeeDetails($_GET['fid']);
    ?>
    <div class="a4-container employees">
        <h3>ပြည်ထောင်စုသမ္မတမြန်မာနိုင်ငံတော်</h3>
        <h4>အလုပ်သမားညွှန်ကြားရေးဦးစီးဌာန</h4>
        <h2>အလုပ်အကိုင်နှင့် အလုပ်သမားရှာဖွေရေးရုံး</h2>
        <h4>အလုပ်သမားပေးပို့သည့်ပုံစံ</h4>
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
                        <td><?= $e_codes[$position] ?? 'N/A' ?></td>
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