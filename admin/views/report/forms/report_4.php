<?php

$departments = $report->getDepartmentPositionEmployedLabors();


?>

<div class="print-container pdf-page">
    <h3>အလုပ်သမားညွှန်ကြားရေးဦးစီးဌာန (မြို့နယ်ရုံး) ဟင်္သာတမြို့၏  <?= engToBurmeseNumber($_POST['year']) ?> ခုနှစ်၊ <?= engToBurmeseNumber($_POST['month']) ?> လအတွက် ဌာနအလိုက် အလုပ်ရရှိသူများစာရင်း</h3>
    <table>
        <thead>
            <tr>
                <th>အမှတ်စဉ်</th>
                <th>ဌာနအမည်နှင့်လိပ်စာ</th>
                <th>ရာထူးအမည်</th>
                <th>ကျား</th>
                <th>မ</th>
                <th>ပေါင်း</th>
                <th>မှတ်ချက်</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $total_male = 0;
            $total_female = 0;
            foreach ($departments as $d):
                $male = (int)$d['occupation']['male'];
                $female = (int)$d['occupation']['female'];
                ?>
                <tr>
                    <td><?= engToBurmeseNumber($no++) ?></td>
                    <td><?= $d['department'] ?>(<?= $d['address'] ?>)</td>
                    <td><?= $d['occupation']['occupation'] ?></td>
                    <td><?= engToBurmeseNumber($male) ?></td>
                    <td><?= engToBurmeseNumber($female) ?></td>
                    <td><?= engToBurmeseNumber($male + $female) ?></td>
                    <td></td>
                </tr>
                <?php
                $total_male += $male;
                $total_female += $female;
            endforeach; ?>
            <tr>
                <td></td>
                <td><b>စုစုပေါင်း</b></td>
                <td></td>
                <td><b><?= engToBurmeseNumber($total_male) ?></b></td>
                <td><b><?= engToBurmeseNumber($total_female) ?></b></td>
                <td><b><?= engToBurmeseNumber($total_male + $total_female) ?></b></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>
