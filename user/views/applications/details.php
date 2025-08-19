<style>
    :root {
        --primary-color: #3b82f6;
        --secondary-color: #6b7280;
        --text-color: #1f2937;
        --background-color: #f3f4f6;
        --card-bg-color: #ffffff;
        --border-color: #e5e7eb;
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        --border-radius-lg: 1rem;
    }

    body {
        font-family: 'Inter', sans-serif;
    }

    #container {
        background: var(--card-bg-color);
        padding: 2.5rem;
        border-radius: var(--border-radius-lg);
        box-shadow: var(--shadow-lg);
        max-width: 900px;
        width: 100%;
        /* text-align: center; */
        margin: auto;
    }

    #container h1 {
        width: fit-content;
        margin: auto;
        margin-bottom: 1.5rem;
        font-size: 2.25rem;
        font-weight: 700;
        color: var(--primary-color);
    }

    h3 {

        color: var(--primary-color);
    }

    #types {
        margin-bottom: 2rem;
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin: auto;
    }

    #types a,
    #container a,
    .status-badge {
        width: fit-content;
        margin: auto;
        display: block;
        padding: 0.75rem 1.5rem;
        border-radius: 9999px;
        /* Pill shape */
        text-decoration: none;
        font-weight: 600;
        transition: background-color 0.3s ease, transform 0.2s ease;
        white-space: nowrap;
    }

    #types a {
        background-color: var(--primary-color);
        color: #fff;
    }

    #types a:hover {
        background-color: #2b70e2;
        transform: translateY(-2px);
    }

    #container p {
        color: var(--secondary-color);
        font-size: 1rem;
        line-height: 1.7;
        margin-bottom: 0;
        text-align: justify;
    }

    .status-badge {
        cursor: default;
        color: #fff !important;
        margin: 0;
    }

    /* Status Colors */
    .rejected {
        background-color: #ef4444;
        /* Red for rejected */
    }

    .rejected:hover {
        background-color: #dc2626;
        transform: translateY(-2px);
    }

    .pending {
        background-color: #f59e0b;
        /* Orange for pending */
    }

    .pending:hover {
        background-color: #d97706;
    }

    .success {
        background-color: #10b981;
        /* Green for success */
    }

    .success:hover {
        background-color: #059669;
    }

    .status-message {
        margin-bottom: 1.5rem;
        font-weight: 500;
        text-align: center;
        padding: 0.75rem 1rem;
        background-color: #fef3c7;
        color: #92400e;
        border-radius: 0.5rem;
        border: 1px solid #fde68a;
    }
</style>

<div id="container">
    <h1>Application</h1>
    <div id="types">
        <?php
        if (isset($_SESSION['applied']) && !$_SESSION['applied']) {
            if ($_SESSION['type'] ?? null && isset($_SESSION['user_id'])) {
                if ($_SESSION['type'] == 'employee'):
                    echo '<a href="?vr=applications&ee">Apply for Employee Card</a>';
                else:
                    echo '<a href="?vr=applications&er">Apply as Employer</a>';
                endif;
            }
        }
        ?>
    </div>
    <?php
    if (!isset($_SESSION['user_id'])):
        ?>
        <a href="<?= BASE_URL ?>/?vr=account&auth=login&msg=You must create an account to Continue" class="status-badge"
            style="background-color: var(--primary-color);">Make An Application</a>
        <?php
    else:
        $userModel = new UserModel();
        $userModel->user_id = (int) $_SESSION['user_id'];
        $status = $userModel->get_registered_status($_SESSION['type']);
        if ($status['status'] ?? null):
            $s = $status['status'];
            if (!$status['is_resubmit']):
                ?>
                <a href="<?= $s == 'Rejected' ? '?vr=applications&' . ($_SESSION['type'] == 'employee' ? 'rj=' : 'rje=') : '' ?>"
                    class="status-badge <?= $s == 'Rejected' ? 'rejected' :
                        ($s == 'Pending' ? 'pending' : 'success') ?>">Application Status: <?= $s ?></a>
            <?php else: ?>
                <p class="status-message">Your resubmitted application is currently under review. We will notify you of the outcome
                    as soon as possible.</p>
            <?php endif; endif; endif; ?>
    <hr style="margin: 20px auto;">
    <h3>Requirements</h3>
    <p>
        To complete your application, please ensure you have provided all the necessary documents, including a valid ID,
        proof of address, and any required certifications. Incomplete applications may result in delays or rejection.
    </p>
</div>