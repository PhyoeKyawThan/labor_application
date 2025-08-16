<?php

$occupation = isset($detail) ? json_decode($detail['occupation'], true)[0] : null;
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['accept'])) {
    if (isset($_GET['pa'])) {
        $to = $_GET['to'];
        $department = $_GET['department'];
        $date = $_GET['date'];
        $letter_no = $_GET['letter_no'];
        $position = $_GET['position'];
        $reqModel->insertDepartmentApproval([
            $to,
            $department,
            $date,
            (int) $_GET['fid']
        ]);
        $detail = $reqModel->readDetails($_GET['fid']);
        require_once __DIR__ . '/accepted_form.php';
        exit;
    }
}

?>
<div id="prefill-accepted-form">
    <a href="<?= parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) . '?vr=employer&fid=' . $_GET['fid'] ?>">
        <i class="fas fa-arrow-left"></i>
    </a>
    <h2>အလုပ်သမား ရှာဖွေရေး ဖောင်</h2>
    <form action="" method="get">
        <input type="hidden" name="vr" value="employer">
        <input type="hidden" name="fid" value="<?= $_GET['fid'] ?>">
        <input type="hidden" name="pf" value="true">
        <input type="hidden" name="accept" value="true">
        <input type="hidden" name="pa" value="true">
        <div>
            <label for="to-line-3">သို့:</label>
            <textarea type="text" name="to" id="to-3" placeholder="မည်သူ့ထံသို့"><?= $detail['toDeliver'] ?></textarea>
        </div>


        <div>
            <label for="department">ဌာန:</label>
            <input type="text" name="department" id="department" value="<?= $detail['name'] ?>" placeholder="ဌာနအမည်">
        </div>

        <div class="grid">
            <div>
                <label for="date">ရက်စွဲ:</label>
                <input type="date" name="date" value="<?php
                $date = new DateTime($detail['submitted_at']);
                echo $date->format('Y-m-d');
                ?>" id="date">
            </div>
            <div>
                <label for="letter-no">စာအမှတ်:</label>
                <input type="text" name="letter_no" id="letter-no" value="<?= $detail['letter_no'] ?? '-' ?>"
                    placeholder="စာအမှတ်">
            </div>
        </div>

        <div>
            <label for="position">လိုအပ်သောရာထူး:</label>
            <input type="text" name="position" id="position" placeholder="လိုအပ်သောရာထူး"
                value="<?= $occupation['occupation'] ?>">
        </div>

        <div class="button-container">
            <button type="submit">
                <?= $detail['status'] == 'Department Approvel' ? ' Request Approval' : ($detail['status'] == 'Finished' ? 'View' : ' Request Approval') ?>
            </button>
        </div>
    </form>
</div>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Myanmar:wght@400;700&display=swap');

    #prefill-accepted-form {
        margin: auto;
        background-color: #ffffff;
        padding: 2rem;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        width: 100%;
        max-width: 42rem;
    }


    #prefill-accepted-form h2 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: #1f2937;
    }


    #prefill-accepted-form form {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }


    #prefill-accepted-form form>div {
        margin: 0;
    }


    #prefill-accepted-form label {
        display: block;
        font-size: 0.875rem;
        line-height: 1.25rem;
        font-weight: 500;
        color: #374151;
        margin-bottom: 0.25rem;
    }


    #prefill-accepted-form input[type="text"],
    #prefill-accepted-form textarea,
    #prefill-accepted-form input[type="date"] {
        display: block;
        width: 100%;
        padding: 0.5rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    #prefill-accepted-form input[type="text"]:focus,
    #prefill-accepted-form input[type="date"]:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.5);
    }

    #prefill-accepted-form .grid {
        display: grid;
        grid-template-columns: repeat(1, minmax(0, 1fr));
        gap: 1.5rem;
    }

    @media (min-width: 768px) {
        #prefill-accepted-form .grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    #prefill-accepted-form .button-container {
        display: flex;
        justify-content: flex-end;
        margin-top: 1.5rem;
    }


    #prefill-accepted-form button {
        display: inline-flex;
        align-items: center;
        padding: 0.75rem 1.5rem;
        border: 1px solid transparent;
        font-size: 1rem;
        font-weight: 500;
        border-radius: 0.375rem;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        color: #ffffff;
        background-color: #2563eb;
        cursor: pointer;
        transition: background-color 0.15s ease-in-out;
    }

    #prefill-accepted-form button:hover {
        background-color: #1d4ed8;
    }

    #prefill-accepted-form input::placeholder {
        color: #9ca3af;
    }
</style>