<?php
define("BASE_URL", '/labor_application/user');
$vr = $_GET['vr'] ?? 'home';
?>
<nav>
    <ul>
        <li><a href="<?= BASE_URL.'?vr=home' ?>" class="<?= $vr == "home" ? 'active' : '' ?>"><i class="fas fa-home"></i> ပင်မစာမျက်နှာ</a></li>
        <li><a href="<?= BASE_URL.'?vr=applications' ?>" class="<?= $vr == "applications" ? 'active' : '' ?>"><i class="fas fa-file-alt"></i> မှတ်ပုံတင်လျှောက်ထားခြင်း</a></li>
        <li><a href="<?= BASE_URL.'?vr=about' ?>" class="<?= $vr == "about" ? 'active' : '' ?>"><i class="fas fa-info-circle"></i> အကြောင်းအရာ</a></li>
    
        <li class="dropdown">
            <a href="#" class="<?= $vr == "account" ? 'active' : '' ?>"><i class="fas fa-user-circle"></i> အကောင့် ▾</a>
            <ul class="dropdown-menu">
                <li><a href="<?= BASE_URL.'?vr=account&p=' ?>"><i class="fas fa-id-card"></i> Profile</a></li>
                <li><a href="<?= BASE_URL.'?vr=account&a=' ?>"><i class="fas fa-file-alt"></i> Applications</a></li>
                <li>
                    <?= 
                        isset($_SESSION['user_id']) ? '<a href="'.BASE_URL.'/views/account/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>' 
                        : '<a href="'.BASE_URL.'/?vr=account&p=&auth=login"><i class="fas fa-sign-in-alt"></i> Login</a>'
                    ?>
                </li>   
            </ul>
        </li>

        <li><a href="<?= BASE_URL.'?vr=contact' ?>" class="<?= $vr == "contact" ? 'active' : '' ?>"><i class="fas fa-envelope"></i> ဆက်သွယ်ရန်</a></li>
    </ul>
</nav>
