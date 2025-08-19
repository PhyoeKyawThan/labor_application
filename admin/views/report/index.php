<div id="report-filter">
    <form action="" method="get">
        <label for="date">Filter Date <i class="fas fa-filter"></i></label>
        <input type="date" name="date" id="date">
        <select name="report_type" id="">
            <option value="1">Employed Age</option>
            <option value="2">Registered Labor</option>
            <option value="3">Education Level</option>
            <option value="4">Employed Department</option>
        </select>
        <input type="submit" value="Search">
    </form>
    <?php
    require __DIR__.'/../../../commons/Connection.php';
    $db = new Connection();
    $connection = $db->get_connection();
    if(isset($_GET['date']) && isset($_GET['report_type'])){
        switch($_GET['report_type']){
            case 1:
                require __DIR__.'/forms/report_1.php';
                break;
            case 2:
                require __DIR__.'/forms/report_2.php';
                break;
            case 3:
                require __DIR__.'/forms/report_3.php';
                break;
            case 4:
                require __DIR__.'/forms/report_4.php';
                break;
        }
    }

?>  
</div>