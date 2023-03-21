<?php
session_start();
session_unset();
session_destroy();
header("Location: ../view/login_register/login_register.html");
?>