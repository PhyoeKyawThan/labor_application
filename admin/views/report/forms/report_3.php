<?php

$labors = $report->getLaborsWithEdu();


?>

<div class="print-container pdf-page">
    <h3>ရုံးတွင် 
        <?= engToBurmeseNumber($_POST['year']) ?> ခုနှစ်၊ 
        <?= engToBurmeseNumber($_POST['month']) ?> လတွင် အသစ်မှတ်ပုံတင်သူများကို ပညာအရည်အချင်းဖြင့်ပြသည့်ဇယား</h3>
    <table>
        <thead>
            <tr>
                <th>အမှတ်စဉ်</th>
                <th>ပညာအရည်အချင်း</th>
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
            function counter($gender, $value){
                $count = 0;
                foreach($value as $v){
                    if($v['gender'] == $gender)
                        $count += 1;
                }
                return $count;
            }
            foreach ($labors as $key => $value):
                $male = counter('Male', $value);
                $female = counter('Female', $value);
                ?>
                <tr>
                    <td><?= engToBurmeseNumber($no++) ?></td>
                    <td><?= $key ?></td>
                    <td><?= engToBurmeseNumber($male) ?></td>
                    <td><?= engToBurmeseNumber($female) ?></td>
                    <td><?= engToBurmeseNumber(count($value)) ?></td>
                </tr>
                <?php
                $total_male += $male;
                $total_female += $female;
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
