<?php

require_once "../vendor/autoload.php";

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

$phone_number = "+4312233444";

if (isset($_POST["tel"])) {
    $phone_number = $_POST["tel"];
}

$result = Builder::create()
    ->writer(new PngWriter())
    ->writerOptions([])
    ->data('tel:' . $phone_number)
    ->encoding(new Encoding('UTF-8'))
    ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
    ->size(300)
    ->margin(10)
    ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
    ->labelText($phone_number)
    ->labelFont(new NotoSans(20))
    ->labelAlignment(new LabelAlignmentCenter())
    ->validateResult(false)
    ->build();

?>
<html>
<head>
    <meta charset="UTF-8">
    <title>PAA</title>
    <link rel="stylesheet" href="../style/style.css">
    <style>
        a {
            color: #EFEEEF;
            background: #0088DF;
            margin: 1em;
            padding: 0.5em;
            border-radius: 0.25rem;
            text-decoration: none;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 15pt;
        }

        a svg {
            fill: #EFEEEF;
            height: 1.5em;
        }
    </style>
</head>
<body>
<a href="../">
    Go Back
    <svg viewBox="0 0 48 48">
        <path d="M14 38v-3h14.45q3.5 0 6.025-2.325Q37 30.35 37 26.9t-2.525-5.775Q31.95 18.8 28.45 18.8H13.7l5.7 5.7-2.1 2.1L8 17.3 17.3 8l2.1 2.1-5.7 5.7h14.7q4.75 0 8.175 3.2Q40 22.2 40 26.9t-3.425 7.9Q33.15 38 28.4 38Z"/>
    </svg>
</a>
<img src="<?php echo $result->getDataUri() ?>">
<a href="<?php echo $result->getDataUri() ?>" download>
    Download
    <svg viewBox="0 0 48 48">
        <path d="M11 40q-1.2 0-2.1-.9Q8 38.2 8 37v-7.15h3V37h26v-7.15h3V37q0 1.2-.9 2.1-.9.9-2.1.9Zm13-7.65-9.65-9.65 2.15-2.15 6 6V8h3v18.55l6-6 2.15 2.15Z"/>
    </svg>
</a>
</body>
</html>