<?php

use Carboneio\SDK\Carbone;

/** Get your API key on your Carbone account: https://account.carbone.io/. **/
$carbone = new Carbone('PRIVATE_API_KEY');

/** Template ID */
$templateId = 'b0126ca004a93dd78c85cbeafb15dd3b9d64ce728c04712adea195c93681ceff';

/**
 * Rendering options:
 * - "data" is required and contains all data injected inside the document
 * - "convertTo" defines the export format
 * - More options: https://carbone.io/api-reference.html#render-reports
 */
$data = [
  'data' => [
    'firstname' => 'John Wick',
  ],
  'convertTo' => 'pdf',
];

/** Generate the document and download it with the same request */
$response = $carbone->renders()->renderAndDownload($templateId, $data);

/** If the file is found: Save the contents of the file yourself on your filesystem */
if ($response->status() !== 404) {
    // To get the custom file name provided through the rendering option "reportName":
    echo 'File name: ' . $response->header('content-disposition');
    // Save file
    file_put_contents('/my_super_doc.pdf', $response->body());
    echo 'File saved! ✅';
} else {
    echo 'File not saved!';
}
