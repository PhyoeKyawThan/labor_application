<main>
    <?php
        if(isset($_GET['ee'])){
            require 'employee_form.php';
        }else if(isset($_GET['er'])){
            require 'employer_form.php';
        }else{
            require 'details.php';
        }
    ?>
</main>