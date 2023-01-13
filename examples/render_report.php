<?php

use Carboneio\SDK\Carbone;

/** Get your API key on your Carbone account: https://account.carbone.io/. **/
$carbone = new Carbone('PRIVATE_API_KEY');

/** Template ID */
$templateId = "b0126ca004a93dd78c85cbeafb15dd3b9d64ce728c04712adea195c93681ceff";

/**
 * Rendering options:
 * - "data" is required and contains all data injected inside the document
 * - "convertTo" defines the export format
 * - More options: https://carbone.io/api-reference.html#render-reports
 */
$data = [
  "data" => [
    "firstname" => "John Wick"
  ],
  "convertTo" =>  "pdf"
];

/** Generate the document */
$response = $carbone->renders()->render($templateId, $data);
$result = $response->json();
echo "Request Status Code: " . $response->status() . "\n";

/** Handle errors */
if ($result['success'] == false) {
  echo "Something went wrong: " . $result['error'] . "\n";
} else {
  /**
   * Success, save the render ID:
   * The render ID is a unique id to download a the generate document
   */
  echo $response->getRenderId();
}

