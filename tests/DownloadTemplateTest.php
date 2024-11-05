<?php


/** Saloon Class */
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

use Carboneio\SDK\Carbone;
use Carboneio\SDK\Requests\Templates\DownloadTemplateRequest;

beforeEach(function () {
    $this->token = "jwt_carbone_token";
    $this->carbone = new Carbone($this->token);
});

it('should download a template', function () {

    $templateId = "afc1879ed3a2dbedac30e5f873d9fdb0cc13528974a7f8ec946ceaf2fbd8fdc9";
    $templateContent = getTemplate();

    $mockClient = new MockClient([
        DownloadTemplateRequest::class => MockResponse::make($templateContent, 200),
    ]);

    $this->carbone->withMockClient($mockClient);

    $response = $this->carbone->templates()->download($templateId);

    expect($response->body())->toBe($templateContent);
    expect($response->status())->toBe(200);

    $mockClient->assertSent('/template/*');
    $mockClient->assertSent(DownloadTemplateRequest::class);
});

it('should return an error if the template does not exist', function () {

    $templateId = "afc1879ed3a2dbedac30e5f873d9fdb0cc13528974a7f8ec946ceaf2fbd8fdc9";
    $expectedResponse = [
        "success" => false,
        "data"    => "Cannot read template",
        "code"    => "w116"
    ];

    $mockClient = new MockClient([
        DownloadTemplateRequest::class => MockResponse::make($expectedResponse, 400),
    ]);

    $this->carbone->withMockClient($mockClient);

    $response = $this->carbone->templates()->download($templateId);
    $json = $response->json();

    $this->assertEquals($json, $expectedResponse);
    expect($response->status())->toBe(400);

    $mockClient->assertSent('/template/*');
    $mockClient->assertSent(DownloadTemplateRequest::class);
});