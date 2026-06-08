<?php
session_start();
session_unset();
session_destroy();

echo "<script>alert('Anda telah berhasil keluar dari sistem.'); window.location='login.php';</script>";
exit;
?>