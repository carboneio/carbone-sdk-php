<?php

use Carboneio\SDK\Carbone;

/** Get your API key on your Carbone account: https://account.carbone.io/. **/
$carbone = new Carbone('PRIVATE_API_KEY');

$templateId = 'b0126ca004a93dd78c85cbeafb15dd3b9d64ce728c04712adea195c93681ceff';

/** Delete the template */
$response = $carbone->templates()->delete($templateId);
$result = $response->json();

/** If the template does not exist */
if ($result['success'] == false) {
    echo 'Details: ' . $result['error'] . "\n";
    echo 'Carbone Error code: ' . $result['code'];
} else {
    /** Success! */
    echo "Deletion succeed!\n";
}
