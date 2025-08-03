<!DOCTYPE html>
<html lang="my">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A4 Printable Form</title>
    <style>
        /* General page and typography styles */
        body {
            font-family: "Myanmar3", "Noto Sans Myanmar", sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }

        /* A4 page dimensions and styling for screen view */
        .a4-page {
            width: 210mm;
            height: 297mm;
            padding: 15mm; /* Reduced padding to fit more content */
            background-color: #fff;
            box-shadow: 0 0 10mm rgba(0, 0, 0, 0.2);
            box-sizing: border-box;
            margin: 20mm auto;
            display: flex;
            flex-direction: column;
            line-height: 1.5;
        }

        /* Header styles */
        .header {
            text-align: center;
        }
        .header-title {
            font-size: 1.2em;
            font-weight: bold;
            margin: 0;
        }
        .header-subtitle {
            margin: 0;
            text-align: right;
            font-size: 0.9em;
        }
        .header-line-item {
            display: flex;
            align-items: center;
            margin-top: 10px;
            font-size: 0.9em;
        }
        .header-line-item p {
            margin: 0;
            width: 150px; /* Fixed width for the label */
        }
        .header-line-item span {
            flex-grow: 1;
            border-bottom: 1px solid #000;
            margin-left: 10px;
            text-align: left;
            height: 1.2em; /* To ensure a consistent line height */
        }

        /* Main content table styles */
        .main-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.8em;
            margin-top: 20px;
            table-layout: fixed; /* Ensures columns are of fixed width */
        }
        .main-table th, .main-table td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
            vertical-align: top;
        }
        .main-table th {
            font-weight: normal;
            background-color: #f9f9f9;
        }
        .main-table td {
            height: 80px; /* Set a fixed height for data rows */
        }

        /* Adjusting for specific table columns */
        .main-table th:nth-child(1) { width: 20%; }
        .main-table th:nth-child(2) { width: 10%; }
        .main-table th:nth-child(3) { width: 10%; }
        .main-table th:nth-child(4) { width: 15%; }
        .main-table th:nth-child(5) { width: 20%; }
        .main-table th:nth-child(6) { width: 10%; }
        .main-table th:nth-child(7) { width: 15%; }


        /* Footer styles */
        .footer {
            margin-top: auto;
            font-size: 0.85em;
        }
        .footer-lines {
            margin-top: 20px;
        }
        .footer-line {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }
        .footer-line-label {
            width: 120px;
        }
        .footer-line span {
            flex-grow: 1;
            border-bottom: 1px solid #000;
            margin-left: 10px;
        }
        .footer-signature-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
            text-align: center;
            padding-right: 50px;
        }
        .footer-signature-line {
            width: 150px;
            border-bottom: 1px solid #000;
            padding: 5px;
            margin-top: 30px;
        }

        /* Print-specific styles */
        @media print {
            body {
                background: none;
                margin: 0;
            }
            .a4-page {
                width: 210mm;
                height: 297mm;
                margin: 0;
                padding: 10mm;
                box-shadow: none;
                border: none;
            }
        }
    </style>
</head>
<body>

    <div class="a4-page">
        <!-- Header Section -->
        <div class="header">
            <div class="header-subtitle">
                <span>အလွယ်ရေး(ပုံစံ-၃)</span>
            </div>
            <div class="header-line-item" style="justify-content: center;">
                <p>အလျှောက်လွှာတင်သွင်းရခြင်းအကြောင်းရင်း</p>
                <span></span>
            </div>
        </div>

        <!-- Pre-Table Lines -->
        <div class="header-line-item" style="margin-top: 20px;">
            <p>၁။ အလျှောက်လွှာတင်သွင်းသူ၏အမည်၊ ရာထူး/ဌာန</p>
            <span></span>
        </div>
        <div class="header-line-item">
            <p>၂။ စာတိုက်သေတ္တာအမှတ်</p>
            <span></span>
        </div>
        <div class="header-line-item">
            <p>၃။ ဖုန်းနံပါတ်</p>
            <span></span>
        </div>
        <div class="header-line-item">
            <p>၄။ အလျှောက်လွှာတင်သွင်းသူမှပေးဆောင်သော အခကြေးငွေ</p>
            <span></span>
        </div>

        <!-- Main Form Content Table -->
        <table class="main-table">
            <thead>
                <tr>
                    <th rowspan="2">အလျှောက်လွှာတင်သွင်းသူ၏အမည်၊ ရာထူး/ဌာန</th>
                    <th rowspan="2">အမှန်တကယ်ဖြစ်ပျက်သည့်အခြေအနေ</th>
                    <th rowspan="2">အလျှောက်လွှာတင်သွင်းသည့်နေ့ရက်</th>
                    <th rowspan="2">မှတ်ချက်</th>
                    <th colspan="2">အမှန်တကယ်ဖြစ်ပျက်သည့်နေ့ရက်</th>
                    <th rowspan="2">အခကြေးငွေပေးဆောင်သည့်အခါ</th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>(၁)</td>
                    <td>(၂)</td>
                    <td>(၃)</td>
                    <td>(၄)</td>
                    <td>(၅)</td>
                    <td>(၆)</td>
                    <td>(၇)</td>
                </tr>
                <!-- Rows for data entry, including the sub-rows in the second column -->
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <!-- Footer Section -->
        <div class="footer">
            <div class="footer-lines">
                <div class="footer-line">
                    <p>စာရွက်အမှတ်</p>
                    <span></span>
                </div>
            </div>
            <div class="footer-signature-container">
                <div>
                    <div class="footer-signature-line"></div>
                    <p>လက်မှတ်</p>
                    <p>ရာထူး/အဆင့်</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
