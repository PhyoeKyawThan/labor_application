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
                စာအမှတ်၊ ၈/၂/အလည-မ(အလခ)( )
            </div>
            <div class="doc-number">
                <span class="label">ရက်စွဲ:</span>
                <?php
                $curr = new DateTime();

                ?>
            </div>
        </div>
    </div>

    <div class="to-section">
        <div class="to-label">
            သို့
        </div>
        <div class="to-line">
            ညွှန်ကြားရေးမှူးချုပ်
        </div>
        <div class="to-line">အလုပ်သမားညွှန်ကြားရေးဦးစီးဌာန</div>
        <div class="to-line">နေပြည်တော်</div>
    </div>

    <div class="main-body">
        <p>
            <span class="to-label">အကြောင်းအရာ။&nbsp;&nbsp;</span> <b>အလလခလချုပ်အစီရင်ခံစာတင်ပြခြင်း</b>
        </p>
        <p style="text-indent: 50px">
            အထက်အကြောင်းအရာပါကိစ္စနှင့်ပတ်သက်၍ (မြို့နယ်ရုံး) ဟင်္သာတမြို့၏ ခုနှစ်၊ လ အတွင်း(ပြည်တွင်း)
            အလုပ်အကိုင်နှင့် အလုပ်သမားရှာဖွေရေး လချုပ် အစီရင်ခံစာ အားတင်ပြအပ်ပါသည်
        </p>
    </div>

    <div class="signature-section" style="text-align: center; float: right;">
        <img src="<?= $detail['department_confirm_sign'] ?? '/labor_application/importants/director_sign.png' ?>" alt=""
            srcset="">
        <div class="sign-label">
            <!-- ဦးစီးမှူး -->
        </div>
        <p></p>
    </div>
    <div class="stamp">
        <img src="<?= $detail['department_confirm_stamp'] ?? '/labor_application/importants/stamp_.png' ?>" alt=""
            srcset="">
    </div>
</div>
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
        page-break-after: always;
        padding: 20px;
        background: #fff;
    }

    .a4-container:last-child {
        page-break-after: auto;
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