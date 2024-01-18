<?php

require "vendor/autoload.php";

// use Endroid\QrCode\Builder\Builder;
// use Endroid\QrCode\ErrorCorrectionLevel;
// use Endroid\QrCode\Label\LabelAlignment;
// use Endroid\QrCode\Label\Font\NotoSans;
// use Endroid\QrCode\RoundBlockSizeMode;
// use Endroid\QrCode\Writer\PngWriter;

// function generateQRCode($sim, $url)
// {
//     $result = Builder::create()
//     ->writer(new PngWriter())
//     ->writerOptions([])
//     ->data($url)
//     ->errorCorrectionLevel(ErrorCorrectionLevel::High)
//     ->size(300)
//     ->margin(10)
//     ->roundBlockSizeMode(RoundBlockSizeMode::Margin)
//     ->labelText('Scan Me')
//     ->labelFont(new NotoSans(20))
//     ->labelAlignment(LabelAlignment::Center)
//     ->validateResult(false)
//     ->build();

//     $result->saveToFile(__DIR__ . '/images/qrcode-' . $sim . '.png');

//     return $result;
// }

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\ValidationException;

function generateQRCode($sim, $url)
{
    $writer = new PngWriter();

    // Create QR code
    $qrCode = QrCode::create($url)
        ->setErrorCorrectionLevel(ErrorCorrectionLevel::Low)
        ->setSize(300)
        ->setMargin(20)
        ->setRoundBlockSizeMode(RoundBlockSizeMode::Margin)
        ->setForegroundColor(new Color(232, 31, 118))
        ->setBackgroundColor(new Color(255, 255, 255));

    // Create generic logo
    $logo = Logo::create(__DIR__ . '/images/logo.png')
        ->setResizeToWidth(150);

    // Create generic label
    $label = Label::create($sim)
        ->setTextColor(new Color(0, 0, 0));

    $result = $writer->write($qrCode, $logo, $label);

    $result->saveToFile(__DIR__ . '/images/qrcode/' . $sim . '.png');

    return $result;
}




