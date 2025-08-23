<main>
    <?php
    require_once __DIR__ . '/../../models/UserModel.php';

    if (isset($_GET['vf'])) {
        require 'view.php';
    } elseif (isset($_GET['ee'])) {
        require 'employee_form.php';
    } else if (isset($_GET['er'])) {
        require 'employer_form.php';
    } else if (isset($_GET['rj'])) {
        require 'employee_rejected.php';
    } else if (isset($_GET['rje'])) {
        require 'employer_rejected.php';
    } else {
        require 'details.php';
    }
    ?>
</main>