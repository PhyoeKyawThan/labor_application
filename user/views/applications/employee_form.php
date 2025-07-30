<?php
require_once __DIR__ . '/helpers/drop_datas.php';
?>
<style>
    main h1 {
        text-align: center;
    }

    form {
        width: 60%;
        margin: auto;
        box-sizing: border-box;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    form .container {
        width: 100%;
        background-color: white;
        padding: 30px;
        border-radius: 8px;

        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        box-sizing: border-box;
        margin: auto;
    }

    div{
        box-sizing: border-box;
    }

    form div {
        width: 95%;
    }

    form label {
        font-weight: bold;
    }

    form input,
    form select {
        width: 100%;
        padding: 8px 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        /* font-size: 1em; */
    }

    form input[type="submit"] {
        background-color: #007b5e;
        color: white;
        border: none;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    form input[type="submit"]:hover {
        background-color: #005f47;
    }

    .attachments {
        width: 90%;
        margin: auto;
        display: flex;
        flex-direction: column;
    }

    .attachment {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgb(0 0 0 / 0.05);
        padding: 24px;
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: box-shadow 0.3s ease;
    }

    .attachment:hover {
        box-shadow: 0 6px 18px rgb(0 0 0 / 0.1);
    }

    .attachment label {
        font-weight: 700;
        font-size: 1.125rem;
        color: #111827;
        margin-bottom: 12px;
        user-select: none;
    }

    .attachment input[type="file"] {
        cursor: pointer;
        border: 2px dashed #d1d5db;
        border-radius: 8px;
        padding: 20px;
        width: 100%;
        font-size: 0.9rem;
        color: #9ca3af;
        transition: border-color 0.3s ease, color 0.3s ease;
        text-align: center;
        background: none;
    }

    .attachment input[type="file"]:hover,
    .attachment input[type="file"]:focus {
        border-color: #2563eb;
        color: #2563eb;
        outline: none;
    }

    .preview {
        margin-top: 16px;
        width: 180px;
        height: 180px;
        background-color: #f3f4f6;
        border: 1px solid #d1d5db;
        border-radius: 12px;
        object-fit: cover;
        box-shadow: 0 2px 8px rgb(0 0 0 / 0.07);
        display: none;
    }

    .status {
        background-color: #007b5e;
        width: fit-content;
        margin: auto;
        padding: 10px 20px;
        border-radius: 10px;
        color: white;
        font-weight: bold;
    }

    .reject-message {
        background-color: #ffe5e5;
        color: #d8000c;
        width: fit-content;
        margin: auto;
        padding: 10px 15px;
        border: 1px solid #d8000c;
        border-radius: 6px;
        margin-top: 10px;
        font-weight: bold;
        font-family: Arial, sans-serif;
    }

    .approv-message {
        background-color: rgb(223, 253, 223);
        color: green;
        width: fit-content;
        margin: 20px auto;
        padding: 10px 15px;
        border: 1px solidrgb(0, 216, 47);
        border-radius: 6px;
        margin-top: 10px;
        font-weight: bold;
        font-family: Arial, sans-serif;
    }

    .reject-message::before {
        content: "Rejected: ";
    }

    .status button {
        padding: 5px 10px;
        font-weight: bold;
        margin: 10px auto;
    }

    #nrc {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }

    #nrc select {
        width: 75px;
        background-color: white;
        border: none;
        font-size: small;
        background-color: antiquewhite;
    }

    #nrc input {
        background-color: antiquewhite;
    }

    @media screen and (max-width: 600px) {
        form {
            width: 100%;
        }

        form .container {
            display: flex;
            flex-direction: column;
        }

        #nrc{
            flex-wrap: wrap;
        }

        #nrc select{
            width: 25%;
            /* font-size: 0.3rem; */
        }
        #nrc input{
            width: 100%;
        }
    }
</style>
<script src="<?= BASE_URL . '/static/js/load_nrc_datas.js' ?>"></script>
<main>
    <h1>မြန်မာအလုပ်သမား စာရင်းသွင်းခြင်း</h1>
    <form action="<?= BASE_URL ?>/submits/submit_application.php" method="POST" id="reg-form"
        enctype="multipart/form-data" onsubmit="return validateForm()">
        <div class="container">
            <div style="grid-column: span 2; display: flex; gap: 20px; align-items: center;">
                <div style="flex: 1;">
                    <label for="pic">
                    <img id="preview" src="/labor-register/static/images/photo_2025-06-07_23-25-37.jpg"
                        alt="Image Preview"
                        style="width: 200px; height: 200px; border: 1px solid #ccc; padding: 5px; object-fit: cover;">
                    </label>
                </div>
                <div style="flex: 1;">
                    <!-- <label for="pic">Choose Image:</label> -->
                    <input type="file" name="picture" id="pic" data-att="Profile" accept="image/*" hidden>
                </div>
            </div>

            <div>
                <label for="name">အမည် (Name):</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div>
                <label for="nrc">မှတ်ပုံတင်အမှတ် (NRC):</label>
                <div id="nrc">
                    <select name="nrc_code" id="nrc-code" required>
                    </select>
                    <p>/</p>
                    <select name="region" id="region" required>
                    </select>
                    <select name="nrc_type" id="nrc-type" required>
                        <option value="နိုင်">နိုင်</option>
                        <option value="ဧည့်">ဧည့်</option>
                    </select>
                    <input type="text" name="nrc_no" placeholder="မှတ်ပုံတင်နံပါတ်" id="nrc-no" maxlength="6">
                </div>
            </div>

            <div>
                <label for="township">မြို့နယ် (Township):</label>
                <select name="township">
                    <?php foreach ($myanmarTownships as $township): ?>
                        <option value="<?= htmlspecialchars($township) ?>"><?= htmlspecialchars($township) ?></option>
                    <?php endforeach; ?>
                </select>

            </div>

            <div>
                <label for="email">Email (Email):</label>
                <input type="email" id="email" name="email">
            </div>

            <div>
                <label for="phone">Phone Number :</label>
                <input type="text" id="phone" name="phone" maxlength="14" required>
            </div>

            <div>
                <label for="birth_date">မွေးသက္ကရာဇ် (Birth Date):</label>
                <input type="date" id="birth_date" name="birth_date" required>
            </div>

            <div>
                <label for="gender">ကျား / မ (Gender):</label>
                <select id="gender" name="gender" required>
                    <option value="Male">ကျား (Male)</option>
                    <option value="Female">မ (Female)</option>
                </select>
            </div>

            <div>
                <label for="religion">ကိုးကွယ်သည့်ဘာသာ (Religion):</label>
                <select name="religion" id="religion" required>
                    <?php foreach ($religions as $religion): ?>
                        <option value="<?= htmlspecialchars($religion) ?>"><?= htmlspecialchars($religion) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="edu_level">ပညာအရည်အချင်း (Education Level):</label>
                <select name="edu_level" id="edu_level" required>
                    <?php foreach ($educationLevels as $level): ?>
                        <option value="<?= htmlspecialchars($level) ?>"><?= htmlspecialchars($level) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="stable_address">အမြဲတမ်းနေရပ်လိပ်စာ (Stable Address):</label>
                <input type="text" id="stable_address" name="stable_address" required>
            </div>
        </div>
        <div class="attachments">
            <div class="attachment">
                <label for="file1">မှတ်ပုံတင် (Front)</label>
                <input type="file" id="file1" name="nrc[0]" accept="image/*" data-att="Nrc"
                    aria-describedby="desc1" multiple />
                <img id="preview1" class="preview" alt="Preview of Image File 1" />
            </div>
            <div class="attachment">
                <label for="file1">မှတ်ပုံတင် (Back)</label>
                <input type="file" id="file1" name="nrc[1]" accept="image/*" data-att="Nrc"
                    aria-describedby="desc1" multiple />
                <img id="preview1" class="preview" alt="Preview of Image File 1" />
            </div>
            <div class="attachment">
                <label for="file2">Certificate</label>
                <input type="file" id="file2" name="certificate" accept="image/*" data-att="Certificate"
                    aria-describedby="desc2" />
                <img id="preview2" class="preview" alt="Preview of Image File 2" />
            </div>
        </div>
        <input type="submit" value="စာရင်းသွင်းမည် (Register)">
    </form>
</main>
<script>
    const birthDateInput = document.getElementById('birth_date');

    if (birthDateInput) {
        const today = new Date();
        const year = today.getFullYear() - 18;
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate()).padStart(2, '0');

        const maxDate = `${year}-${month}-${day}`;
        birthDateInput.max = maxDate;
    }


    function validateForm() {
        const nrc = document.getElementById("nrc").value;
        const files = document.querySelectorAll('input[type=file]');
        const phone = document.getElementById("phone").value;
        const myanmarPhonePattern = /^(?:\+?959|09)\d{7,9}$/;


        if (!myanmarPhonePattern.test(phone)) {
            alert("Wrong phone number format");
            return false;
        }


        let attachments = [];
        files.forEach(file => {
            if (file.files.length === 0) {
                attachments.push(file);
            }
        });

        if (attachments.length > 0) {
            let msg = "Please provide the following attachments:\n";
            attachments.forEach(att => {
                msg += att.dataset.att + "\n";
            });
            alert(msg);
            return false;
        }
        return true;
    }
    const pic = document.getElementById('pic');
    pic && pic.addEventListener('change', function (event) {
        const preview = document.getElementById('preview');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(file);
        }
    });
    function setupPreview(inputId, previewId) {
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);

        input.addEventListener('change', () => {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        });
    }

    document.getElementById("reg-form") && ['file1', 'file2'].forEach((inputId, idx) => {
        setupPreview(inputId, 'preview' + (idx + 1));
    });


</script>