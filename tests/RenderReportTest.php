<?php

/** Saloon Class */
use Sammyjo20\Saloon\Clients\MockClient;
use Sammyjo20\Saloon\Http\MockResponse;

use Carboneio\SDK\Carbone;
use Carboneio\SDK\Requests\Reports\RenderReportRequest;

beforeEach(function () {
    $this->token = "jwt_carbone_token";
    $this->carbone = new Carbone($this->token);
});

it('Should render a report from a template ID and should return a render ID', function () {

    $templateId = "afc1879ed3a2dbedac30e5f873d9fdb0cc13528974a7f8ec946ceaf2fbd8fdc9";
    $renderId = "MTAuMjAuMjEuNDEgICAgOpJ9Qgp6OEl5Ea5ACsPjMAcmVwb3J0.docx";
    $expectedResponse = [
        "success" => true,
        "data"    => [
          "renderId" => $renderId
        ]
    ];
    $bodyRequest = [
        "data" => [
            "firstname" => "John"
        ],
        "convertTo" => "docx"
    ];

    $mockClient = new MockClient([
        RenderReportRequest::class => MockResponse::make($expectedResponse, 200)
    ]);

    $this->carbone->withMockClient($mockClient);

    $response = $this->carbone->renders()->render($templateId, $bodyRequest);
    $json = $response->json();
    expect($response->getRenderId())->toBe($renderId);
    $this->assertEquals($json, $expectedResponse);
    expect($response->status())->toBe(200);

});

it('Should return an error 404 if the template if not found', function () {

    $templateId = "afc1879ed3a2dbedac30e5f873d9fdb0cc13528974a7f8ec946ceaf2fbd8fdc9";

    $expectedResponse = [
        "success" => false,
        "error" => "Template not found",
        "code" =>  "w100"
    ];
    $bodyRequest = [
        "data" => [
            "firstname" => "John"
        ],
        "convertTo" => "docx"
    ];

    $mockClient = new MockClient([
        RenderReportRequest::class => MockResponse::make($expectedResponse, 404)
    ]);

    $this->carbone->withMockClient($mockClient);

    $response = $this->carbone->renders()->render($templateId, $bodyRequest);
    $json = $response->json();

    $this->assertEquals($json, $expectedResponse);
    expect($response->status())->toBe(404);

});


it('Should return an error if the template design is not correct', function () {

    $templateId = "afc1879ed3a2dbedac30e5f873d9fdb0cc13528974a7f8ec946ceaf2fbd8fdc9";

    $expectedResponse = [
        "success" => false,
        "error" => "Error while rendering template Error: Missing at least one showEnd or hideEnd",
        "code" =>  "w101"
    ];
    $bodyRequest = [
        "data" => [
            "firstname" => "John"
        ],
        "convertTo" => "docx"
    ];

    $mockClient = new MockClient([
        RenderReportRequest::class => MockResponse::make($expectedResponse, 404)
    ]);

    $this->carbone->withMockClient($mockClient);

    $response = $this->carbone->renders()->render($templateId, $bodyRequest);
    $json = $response->json();

    $this->assertEquals($json, $expectedResponse);
    expect($response->status())->toBe(404);
});

