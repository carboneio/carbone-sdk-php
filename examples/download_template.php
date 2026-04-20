<?php

use Carboneio\SDK\Carbone;

/** Get your API key on your Carbone account: https://account.carbone.io/. **/
$carbone = new Carbone('PRIVATE_API_KEY');

$templateId = 'b0126ca004a93dd78c85cbeafb15dd3b9d64ce728c04712adea195c93681ceff';

/** Download the template based on the template ID */
$response = $carbone->templates()->download($templateId);

echo 'Request Status Code: ' . $response->status() . "\n";

/** If the file is found: Save the contents of the file yourself on your filesystem */
if ($response->status() !== 404) {
    file_put_contents('template.odt', $response->body());
    echo 'File saved! ✅';
    /** If the file is not found */
} else {
    echo 'File not saved!';
}
