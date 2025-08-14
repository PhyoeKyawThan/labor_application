<?php
define("BASE_URL", '/labor_application/user');
?>
<nav>
    <ul>
        <li><a href="<?= BASE_URL.'?vr=home' ?>"><i class="fas fa-home"></i> ပင်မစာမျက်နှာ</a></li>
        <li><a href="<?= BASE_URL.'?vr=applications' ?>"><i class="fas fa-file-alt"></i> မှတ်ပုံတင်လျှောက်ထားခြင်း</a></li>
        <li><a href="<?= BASE_URL.'?vr=about' ?>"><i class="fas fa-info-circle"></i> အကြောင်းအရာ</a></li>
        <li><a href="<?= BASE_URL.'?vr=account' ?>"><i class="fas fa-user-circle"></i> အကောင့်</a></li>
        <li><a href="<?= BASE_URL.'?vr=contact' ?>"><i class="fas fa-envelope"></i> ဆက်သွယ်ရန်</a></li>
    </ul>
</nav>
