<?php
session_start();
session_unset();
session_destroy();
header('Location: /labor_application/admin');
exit;
