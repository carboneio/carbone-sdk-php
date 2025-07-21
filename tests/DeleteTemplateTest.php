<?php


/** Saloon Class */
use Carboneio\SDK\Carbone;
use Saloon\Http\Faking\MockClient;

use Saloon\Http\Faking\MockResponse;
use Carboneio\SDK\Requests\Templates\DeleteTemplateRequest;

beforeEach(function () {
    $this->token = 'jwt_carbone_token';
    $this->carbone = new Carbone($this->token);
});

it('should delete a template', function () {

    $templateId = 'afc1879ed3a2dbedac30e5f873d9fdb0cc13528974a7f8ec946ceaf2fbd8fdc9';
    $expectedResponse = [
        'success' => true,
        'data' => 'Template deleted',
    ];

    $mockClient = new MockClient([
        DeleteTemplateRequest::class => MockResponse::make($expectedResponse, 200),
    ]);

    $this->carbone->withMockClient($mockClient);

    $response = $this->carbone->templates()->delete($templateId);
    $json = $response->json();

    $this->assertEquals($json, $expectedResponse);
    expect($response->status())->toBe(200);
    expect(isset($json['error']))->toBe(false);
    expect(isset($json['code']))->toBe(false);

    $mockClient->assertSent('/template/*');
    $mockClient->assertSent(DeleteTemplateRequest::class);
});

it('should return an error if the template does not exist anymore', function () {

    $templateId = 'afc1879ed3a2dbedac30e5f873d9fdb0cc13528974a7f8ec946ceaf2fbd8fdc9';
    $expectedResponse = [
        'success' => false,
        'data' => 'Cannot remove template, does it exist?',
        'code' => 'w105',
    ];

    $mockClient = new MockClient([
        DeleteTemplateRequest::class => MockResponse::make($expectedResponse, 400),
    ]);

    $this->carbone->withMockClient($mockClient);

    $response = $this->carbone->templates()->delete($templateId);
    $json = $response->json();

    $this->assertEquals($json, $expectedResponse);
    expect($response->status())->toBe(400);

    $mockClient->assertSent('/template/*');
    $mockClient->assertSent(DeleteTemplateRequest::class);
});
