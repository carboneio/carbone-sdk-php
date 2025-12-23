<?php

use Carboneio\SDK\Carbone;

/** Get your API key on your Carbone account: https://account.carbone.io/. **/
$carbone = new Carbone('PRIVATE_API_KEY');

/** Render ID */
$renderID = 'b0126ca004a93dd78c85cbeafb15dd3b9d64ce728c04712adea195c93681ceff';

$response = $carbone->renders()->download($renderId);

/** If the file is found: Save the contents of the file yourself on your filesystem */
if ($response->status() !== 404) {
    // To get the custom file name provided through the rendering option "reportName":
    echo 'File name: ' . $response->header('content-disposition');
    // Save file
    file_put_contents($renderId, $response->body());
    echo 'File saved! ✅';
} else {
    echo 'File not saved!';
}
