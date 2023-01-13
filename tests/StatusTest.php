<?php

/** Saloon Class */
use Sammyjo20\Saloon\Clients\MockClient;
use Sammyjo20\Saloon\Http\MockResponse;

use Carboneio\SDK\Carbone;
use Carboneio\SDK\Requests\StatusRequest;

beforeEach(function () {
    $this->token = "jwt_carbone_token";
    $this->carbone = new Carbone($this->token);
});

it('Should return the status 200 of the API', function () {

    $expectedResponse =  [
        "success" => true,
        "code"    => 200,
        "message" => "OK",
        "version" => "4.6.7"
    ];

    $mockClient = new MockClient([
        StatusRequest::class => MockResponse::make($expectedResponse, 200)
    ]);

    $this->carbone->withMockClient($mockClient);

    $response = $this->carbone->getStatus();
    expect($response->status())->toBe(200);

    $this->assertEquals($response->json(), $expectedResponse);

    $mockClient->assertSent('/status');
    $mockClient->assertSent(StatusRequest::class);
});

it('Should return the status 500 of the API', function () {

    $expectedResponse =  [
        "success" => false,
        "code"    => 500,
        "message" => "/",
        "version" => "4.6.7"
    ];

    $mockClient = new MockClient([
        StatusRequest::class => MockResponse::make($expectedResponse, 500)
    ]);

    $this->carbone->withMockClient($mockClient);

    $response = $this->carbone->getStatus();
    expect($response->status())->toBe(500);

    $this->assertEquals($response->json(), $expectedResponse);

    $mockClient->assertSent('/status');
    $mockClient->assertSent(StatusRequest::class);
});