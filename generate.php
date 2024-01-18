<?php

require "pdf.php";

$sim = $_POST["sim"];
$url = "https://selfsign-dev.geenet.com.sg/activate?sim=" . $sim;

$qrcode = generateQRCode($sim, $url);

generatePDF($sim);