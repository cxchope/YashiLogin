<?php
$argv = count($_POST) > 0 ? $_POST : $_GET;
if (isset($argv["n"]) && isset($argv["s"])) {
    require_once "nyacore.class.php";
    require_once 'nyatotp.class.php';
    $nyatotp = new nyatotp();
    $nyatotp->newdevicetotp($argv["n"],$argv["s"]);
}
?>