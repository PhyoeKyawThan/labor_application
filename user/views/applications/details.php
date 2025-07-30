<style>
    #container {
        background: #fff;
        padding: 2rem 2.5rem;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        max-width: 500px;
        width: 100%;
        text-align: center;
        margin: auto;
    }

    #container h1 {
        margin-bottom: 1.2rem;
        font-size: 2rem;
        color: #333;
    }

    #types {
        margin-bottom: 1.5rem;
    }

    #types a,
    #container a {
        display: inline-block;
        padding: 0.6rem 1.4rem;
        margin: 0 0.5rem;
        border-radius: 30px;
        background-color: #4a90e2;
        color: #fff;
        text-decoration: none;
        font-weight: 600;
        transition: background 0.3s ease;
    }

    #types a:hover {
        background-color: #357ab8;
    }

    #container p {
        color: #666;
        font-size: 0.95rem;
        line-height: 1.6;
    }

    .rejected {
        background-color: #e74c3c !important;
        /* Red for rejected */
        color: #fff !important;
        cursor: pointer;
        /* Indicate it's clickable if there's a link */
    }

    .rejected:hover {
        background-color: #c0392b !important;
    }

    .pending {
        background-color: #f39c12 !important;
        /* Orange/Yellow for pending */
        color: #fff !important;
        cursor: default;
        /* Indicate it's not clickable for pending */
    }

    .pending:hover {
        background-color: #e67e22 !important;
    }

    .success {
        background-color: #2ecc71 !important;
        /* Green for success */
        color: #fff !important;
        cursor: default;
        /* Indicate it's not clickable for success */
    }

    .success:hover {
        background-color: #27ae60 !important;
    }
</style>

<div id="container">
    <h1>Application</h1>
    <div id="types">
        <?php
        if (isset($_SESSION['applied']) && !$_SESSION['applied']) {
            if ($_SESSION['type'] ?? null && isset($_SESSION['user_id'])) {
                if ($_SESSION['type'] == 'employee'):
                    echo '<a href="?vr=applications&ee">Application For Employee card</a>';
                else:
                    echo '<a href="?vr=applications&er">Employer</a>';
                endif;
            }
        }
        ?>
    </div>
    <?php
    if (!isset($_SESSION['user_id'])):
        ?>
        <a href="<?= BASE_URL ?>/?vr=account&auth=login&msg=You must create an account to Continue">Make An Application</a>
        <?php
    else:
        $userModel = new UserModel();
        $userModel->user_id = (int) $_SESSION['user_id'];
        $status = $userModel->get_registered_status();
        if ($status['status'] ?? null):
            $s = $status['status'];
            if (!$status['is_resubmit']):
                ?>
                <a href="<?= $s == 'Rejected' ? '?vr=applications&rj=' : '' ?>" class="<?= $s == 'Rejected' ? 'rejected' :
                            ($s == 'Pending' ? 'pending' : 'success') ?>">Your application Status: <?= $s ?></a>
            <?php else: ?>
                <p class="pending">Your Resubmitted Application is checking underway..</p>
            <?php endif; endif; endif; ?>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit quos illum, accusantium rerum in possimus
        laborum! Mollitia a eius laudantium nulla odio quae cupiditate, nam suscipit aliquid deserunt facere fugiat.</p>
</div>