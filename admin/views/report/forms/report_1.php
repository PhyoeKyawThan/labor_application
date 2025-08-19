<?php

$labors = $report->getEmployedLabors();

$age_group = [
    "18-25" => [
        "male" => 0,
        "female" => 0,
    ],
    "26-35" => [
        "male" => 0,
        "female" => 0,
    ],
    "36-45" => [
        "male" => 0,
        "female" => 0,
    ],
];

foreach ($labors as $l) {
    $age = (int) $l['age'];
    $gender = strtolower($l['gender']);
    if ($age >= 18 && $age <= 25) {
        $age_group["18-25"][$gender]++;
    } elseif ($age >= 26 && $age <= 35) {
        $age_group["26-35"][$gender]++;
    } elseif ($age >= 36 && $age <= 45) {
        $age_group["36-45"][$gender]++;
    }
}

?>

<div id="print-container">
    <h3>အလုပ်သမား ညွှန်ကြားရေးဦးစီးဌာန (မြို့နယ်ရုံး) ဟင်္သာတမြို့၏ (<?= $date ?>)လ အတွက် အလုပ်ရရှိသူများ၏ အသက်အပိုင်းအခြားအလိုက်
        ဖော်ပြသည့်စာရင်း</h3>
    <table>
        <thead>
            <tr>
                <th>အမှတ်စဉ်</th>
                <th>အသက်အပိုင်းအခြား</th>
                <th>ကျား</th>
                <th>မ</th>
                <th>ပေါင်း</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $total_male = 0;
            $total_female = 0;
            foreach ($age_group as $key => $value):
                $age = explode('-', $key);
                ?>
                <tr>
                    <td><?= engToBurmeseNumber($no++) ?></td>
                    <td>အသက် <?= $age[0] ?> နှစ် မှ <?= $age[1] ?> နှစ်ထိ ဦးရေ</td>
                    <td><?= engToBurmeseNumber($value['male']) ?></td>
                    <td><?= engToBurmeseNumber($value['female']) ?></td>
                    <td><?= engToBurmeseNumber($value['male'] + $value['female']) ?></td>
                </tr>
                <?php
                $total_male += $value['male'];
                $total_female += $value['female'];
            endforeach; ?>
            <tr>
                <td></td>
                <td><b>စုစုပေါင်း</b></td>
                <td><b><?= engToBurmeseNumber($total_male) ?></b></td>
                <td><b><?= engToBurmeseNumber($total_female) ?></b></td>
                <td><b><?= engToBurmeseNumber($total_male + $total_female) ?></b></td>
            </tr>
        </tbody>
    </table>
</div>
