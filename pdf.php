<?php

require __DIR__ . "/vendor/autoload.php";
require "qrcode.php";

use Dompdf\Dompdf;
use Dompdf\Options;

function generatePDF($sim)
{
    $qrcodeImg = __DIR__ . '/images/qrcode/' . $sim . '.png';

    $options = new Options;
    $options->setChroot(__DIR__);
    $options->setIsRemoteEnabled(true);

    $dompdf = new Dompdf($options);
    $dompdf->setPaper("A4", "portrait");

    $html = file_get_contents(__DIR__ . "/view/template.html");

    $html = str_replace(
        ["{{ qrcodeImg }}", "{{ sim }}"],
        [$qrcodeImg, $sim],
        $html
    );

    $fileName = $sim . '.pdf';

    $dompdf->loadHtml($html);
    $dompdf->render();
    $dompdf->addInfo("Title", "Online Letterhead");
    $dompdf->stream($fileName, ["Attachment" => 0]);

    $output = $dompdf->output();
    $pdfFilePath = 'storage/' . $fileName;
    file_put_contents($pdfFilePath, $output);
}