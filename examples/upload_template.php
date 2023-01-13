<?php

use Carboneio\SDK\Carbone;

/** Get your API key on your Carbone account: https://account.carbone.io/. **/
$carbone = new Carbone('PRIVATE_API_KEY');

/** Load the local file and compute the template content as base64 */
$templateAsBase64 = base64_encode(file_get_contents("./template.odt"));

/** Upload the file */
$response = $carbone->templates()->upload($templateAsBase64);

/** Get template ID */
echo "Template ID " . $response->getTemplateId();

/**
 * From the template ID you can:
 * - Generate documents
 * - Delete the template
 * - Download the template
 */