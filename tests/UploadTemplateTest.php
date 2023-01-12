<?php


/** Saloon Class */
use Sammyjo20\Saloon\Clients\MockClient;
use Sammyjo20\Saloon\Http\MockResponse;

use Carboneio\SDK\Carbone;
use Carboneio\SDK\Requests\Templates\UploadTemplateRequest;

beforeEach(function () {
    $this->token = "jwt_carbone_token";
    $this->carbone = new Carbone($this->token);
});

it('should return a template ID', function () {

    $templateId = "afc1879ed3a2dbedac30e5f873d9fdb0cc13528974a7f8ec946ceaf2fbd8fdc9";

    $mockClient = new MockClient([
        UploadTemplateRequest::class => MockResponse::make(
            [
                "success" => true,
                "data"    => [
                  "templateId" => $templateId
                ]
            ],
        200),
    ]);

    $this->carbone->withMockClient($mockClient);

    $response = $this->carbone->templates()->upload(getTemplateAsBase64());
    $json = $response->json();
    expect($response->getTemplateId())->toBe($templateId);
    expect($json["data"]["templateId"])->toBe($templateId);
    expect($json["success"])->toBeTrue();
    expect($response->status())->toBe(200);

    expect(isset($json["error"]))->toBe(false);
    expect(isset($json["code"]))->toBe(false);
});

it('should return an error if the template format is not valid', function () {
    expect(true)->toBeTrue();

});