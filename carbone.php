<?php

class CarboneSDK {

  public $API_URL = "http://localhost:4000"; // "https://render.carbone.io"
  public $TOKEN_HEADER = 'Authorization: Bearer .......';

  function __construct($API_KEY, $API_URL) {
    $this->API_KEY = $API_KEY ?? '';
    $this->API_URL = $API_URL ?? 'https://render.carbone.io';
  }

  function set_api_url ($API_URL) {
    $this->API_URL = $API_URL ?? 'https://render.carbone.io';
  }

  function get_api_url () {
    return $this->API_URL;
  }

  function upload_template() {
    echo "Function - UPLOAD TEMPLATE<br/>";

    $data = array (
      "template" => new CURLFile(dirname(__FILE__)."/template.odt")
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->API_URL . "/template");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    // curl_setopt($ch, CURLOPT_HTTPHEADER, array($TOKEN_HEADER, "Expect:"));
    // curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    // curl_setopt($ch, CURLOPT_VERBOSE,true);
    // curl_setopt($ch, CURLOPT_ENCODING,"");
    // Execute the POST request
    $result = curl_exec($ch);
    curl_close($ch);
    return json_decode($result, true);;
  }

  function render_report ($template_id) {
    $ch = curl_init();

    $data = json_encode(array(
      "data" => array (
        "firstname" => "steeve",
        "lastname" => "payraudeau"
      )
    ));

    curl_setopt($ch, CURLOPT_URL, $this->API_URL . "/render/" . $template_id);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER,
      array(
        'Content-Type:application/json',
        'Content-Length: ' . strlen($data)
      )
    );
    $result = curl_exec($ch);
    curl_close($ch);
    return json_decode($result, true);;
  }

  function get_report ($render_id) {
    echo "<br/>Function - UPLOAD TEMPLATE<br/>".$render_id;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->API_URL . "/render/" . $render_id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $response = curl_exec($ch);
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = substr($response, 0, $header_size);
    $body = substr($response, $header_size);
    curl_close($ch);
    return array("file" => $body, "filename" => $header);
  }

}

$carboneSDK = new CarboneSDK("", "http://localhost:4000");

// ---------------- ADD TEMPLATE
// try {
//   $resp = $carboneSDK->upload_template();
//   echo "Template ID: " . $resp['data']['templateId'];
// } catch (Exception $e) {
//   var_dump($e);
// }

// ---------------- RENDER REPORT
try {
  $resp = $carboneSDK->render_report("d7e45a1e4b6f0489c3286c05caf83004fb469acca19ad28bfcf88c5ab7640ad1");
  echo "Render ID: " . $resp["data"]["renderId"];
  $fileContent = $carboneSDK->get_report($resp["data"]["renderId"]);
  var_dump($fileContent["filename"]);
  // $Handle = fopen("tmp.odt", 'w');
  // fwrite($Handle, $fileContent);
  // fclose($Handle);

  // var_dump($file);
} catch (Exception $e) {
  var_dump($e);
}








// try {
//   $response = uploadTemplate();
//   echo "<br><br><br><br>";
//   var_dump($response['data']['templateId']);
// } catch(Exception $e) {
//   var_dump($e);
// }


  // /** BEGIN -  DEBUG */
  // $fp = fopen(dirname(__FILE__).'/errorlog.txt', 'w');
  // curl_setopt($ch, CURLOPT_VERBOSE, true);
  // curl_setopt($ch, CURLOPT_STDERR, $fp);
  // /** END - DEBUG */

  // echo "<h2>ERROR</h2>";
  // $errors = curl_error($ch);
  // $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  // var_dump($errors );
  // echo "<br/><br/><h2>STATUS</h2>";
  // var_dump($response);
  // echo "<br/><br/><h2>RESPONSE</h2>";
  // var_dump($result);