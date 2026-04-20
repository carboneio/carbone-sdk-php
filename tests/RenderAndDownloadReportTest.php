<?php

/** Saloon Class */

use Carboneio\SDK\Carbone;
use Saloon\Http\Faking\MockClient;

use Saloon\Http\Faking\MockResponse;
use \Carboneio\SDK\Requests\Reports\RenderAndDownloadReportRequest;

beforeEach(function () {
    $this->token = 'jwt_carbone_token';
    $this->carbone = new Carbone($this->token);
});

it('Should render a report from a template ID and should return the rendered report', function () {

    $templateId = 'afc1879ed3a2dbedac30e5f873d9fdb0cc13528974a7f8ec946ceaf2fbd8fdc9';
    $resultContent = getResult();

    $bodyRequest = [
        'data' => [
            'firstname' => 'John',
        ],
        'convertTo' => 'docx',
    ];

    $mockClient = new MockClient([
        RenderAndDownloadReportRequest::class => MockResponse::make($resultContent, 200),
    ]);

    $this->carbone->withMockClient($mockClient);

    $response = $this->carbone->renders()->renderAndDownload($templateId, $bodyRequest);

    expect($response->body())
        ->toBe($resultContent)
        ->and($response->status())
        ->toBe(200);

    $mockClient->assertSent('/render/*');
    $mockClient->assertSent(RenderAndDownloadReportRequest::class);

});

it('Should return an error 404 if the template if not found', function () {

    $templateId = 'afc1879ed3a2dbedac30e5f873d9fdb0cc13528974a7f8ec946ceaf2fbd8fdc9';

    $expectedResponse = [
        'success' => false,
        'error' => 'Template not found',
        'code' => 'w100',
    ];
    $bodyRequest = [
        'data' => [
            'firstname' => 'John',
        ],
        'convertTo' => 'docx',
    ];

    $mockClient = new MockClient([
        RenderAndDownloadReportRequest::class => MockResponse::make($expectedResponse, 404),
    ]);

    $this->carbone->withMockClient($mockClient);

    $response = $this->carbone->renders()->renderAndDownload($templateId, $bodyRequest);
    expect($response->status())->toBe(404);

    $json = $response->json();

    $this->assertEquals($json, $expectedResponse);

    $mockClient->assertSent('/render/*');
    $mockClient->assertSent(RenderAndDownloadReportRequest::class);
});


it('Should return an error if the template design is not correct', function () {

    $templateId = 'afc1879ed3a2dbedac30e5f873d9fdb0cc13528974a7f8ec946ceaf2fbd8fdc9';

    $expectedResponse = [
        'success' => false,
        'error' => 'Error while rendering template Error: Missing at least one showEnd or hideEnd',
        'code' => 'w101',
    ];
    $bodyRequest = [
        'data' => [
            'firstname' => 'John',
        ],
        'convertTo' => 'docx',
    ];

    $mockClient = new MockClient([
        RenderAndDownloadReportRequest::class => MockResponse::make($expectedResponse, 404),
    ]);

    $this->carbone->withMockClient($mockClient);

    $response = $this->carbone->renders()->renderAndDownload($templateId, $bodyRequest);
    expect($response->status())->toBe(404);

    $json = $response->json();
    $this->assertEquals($json, $expectedResponse);

    $mockClient->assertSent('/render/*');
    $mockClient->assertSent(RenderAndDownloadReportRequest::class);
});
