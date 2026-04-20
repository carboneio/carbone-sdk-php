<?php


/** Saloon Class */
use Carboneio\SDK\Carbone;
use Saloon\Http\Faking\MockClient;

use Saloon\Http\Faking\MockResponse;
use Carboneio\SDK\Requests\Reports\DownloadReportRequest;

beforeEach(function () {
    $this->token = 'jwt_carbone_token';
    $this->carbone = new Carbone($this->token);
});

it('should download a report', function () {

    $renderId = 'MTAuMjAuMjEuNDEgICAgOpJ9Qgp6OEl5Ea5ACsPjMAcmVwb3J0.docx';
    $resultContent = getResult();

    $mockClient = new MockClient([
        DownloadReportRequest::class => MockResponse::make($resultContent, 200),
    ]);

    $this->carbone->withMockClient($mockClient);

    $response = $this->carbone->renders()->download($renderId);

    expect($response->body())->toBe($resultContent);
    expect($response->status())->toBe(200);

    $mockClient->assertSent('/render/*');
    $mockClient->assertSent(DownloadReportRequest::class);
});

it('should return an error if the render does not exist', function () {

    $renderId = 'MTAuMjAuMjEuNDEgICAgOpJ9Qgp6OEl5Ea5ACsPjMAcmVwb3J0.docx';
    $expectedResponse = [
        'success' => false,
        'data' => 'File not found',
        'code' => 'w104',
    ];

    $mockClient = new MockClient([
        DownloadReportRequest::class => MockResponse::make($expectedResponse, 404),
    ]);

    $this->carbone->withMockClient($mockClient);

    $response = $this->carbone->renders()->download($renderId);
    $json = $response->json();

    $this->assertEquals($json, $expectedResponse);
    expect($response->status())->toBe(404);

    $mockClient->assertSent('/render/*');
    $mockClient->assertSent(DownloadReportRequest::class);
});
