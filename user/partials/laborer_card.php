
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
<style>
    #labor-card {
        /* display: none; */
        width: 600px;
        height: fit-content;
        display: none;
        padding: 20px;
        justify-content: space-between;
        background-color: rgb(229, 211, 211);
        color: black;
        font-weight: bold;
        font-size: 10px;
    }

    #labor-card #rules {
        width: 300px;
        padding: 10px;
        text-align: justify;
    }

    #labor-card #details {
        width: 300px;
        padding: 10px;
    }

    #details .first {
        display: flex;
        justify-content: space-between;
    }

    #details .second {
        text-align: center;
        line-height: 2;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .second span {
        width: 400px;
    }

    .title {
        text-decoration: underline;
        text-align: center;
    }

    table tr,
    td {
        text-align: left;
        padding: 10px;
    }

    #details p {}
</style>
<div id="labor-card">
    <div id="rules">
        မှတ်ချက် အလုပ်အကိုင်နှင့် စပ်လျဉ်း၍ ဦးစီးအရာရှိနှင့် လာရောက်တိုင်ပင်သည့်အခါတွင် ဤလက်မှတ် ယူခဲ့ရမည်။ အကယ်၍
        အလုပ်အကိုင်ရရှိခဲ့သော် အလုပ်အကိုင်နှင့် အလုပ်သမားရှာဖွေရေးရုံးသို့ အလုပ်သမားမှတ်ပုံတင်ကတ်ပြား၏အမှတ်စဉ်
        ကိုဖော်ပြ၍ အကြောင်းကြားရမည်။
        ဤလက်မှတ်ကို (တစ်နှစ်) တစ်ကြိမ် လဲလှယ် ရမည်။ မိမိကိုယ်တိုင်လာရောက်ရန် အခက်အခဲ ရှိပါက
        စာဖြင့်ဖြစ်စေ၊လူလွှတ်၍ဖြစ်စေ လဲလှယ် နိုင်သည်။
    </div>
    <div id="details">
        <div class="first">
            <div>အလလခ(ပုံစံ ၂)</div>
            <div>အမှတ်စဉ် <?= $laborer['serial_number'] ?></div>
        </div>
        <div class="second"><span>ပြည်ထောင်စုသမ္မတမြန်မာနိုင်ငံတော်အစိုးရ</span>
            <span>အလုပ်သမားညွှန်ကြားရေးဦးစီးဌာန</span>
            <span>အလုပ်အကိုင်နှင့်အလုပ်သမားရှာဖွေရေးရုံး</span>
        </div>
        <div class="title">အလုပ်သမားမှတ်ပုံတင်ကတ်ပြား</div>
        <table>
            <tr>
                <th>အမည်</th>
                <td><?= $laborer['name'] ?></td>
            </tr>
            <tr>
                <th>မှတ်ပုံတင်အမှတ်</th>
                <td><?= $laborer['nrc'] ?></td>
            </tr>
            <tr>
                <th>နေရပ်လိပ်စာ</th>
                <td><?= $laborer['stable_address'] ?></td>
            </tr>
            <tr>
                <th>အသိအမှတ်ပြုရက်စွဲ</th>
                <td><?php $date = new DateTime();
                echo $date->format("M j, Y") ?></td>
            </tr>
        </table>
        <!-- <p>ရုံးတာဝန်ခံ</p> -->
    </div>
</div>
<script>
    function saveCard() {
        const target = document.getElementById("labor-card");
        target.style.display = "flex";
        html2canvas(target).then(canvas => {
            // Create a link and trigger download
            const link = document.createElement("a");
            link.download = "<?= $laborer['serial_number'] ?>.png";
            link.href = canvas.toDataURL("image/png");
            link.click();
        });
        target.style.display = "none";
    }
</script>
