<?php

/** Saloon Class */
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

use Carboneio\SDK\Carbone;
use Carboneio\SDK\Requests\StatusRequest;
use Carboneio\SDK\Exceptions\CarboneSdkRequestException;

beforeEach(function () {
    $this->token = "jwt_carbone_token";
    $this->carbone = new Carbone($this->token);
});

it('toException returns a CarboneSdkRequestException with the response body on failure', function () {
    $expectedBody = json_encode(["success" => false, "error" => "Internal Server Error"]);

    $mockClient = new MockClient([
        StatusRequest::class => MockResponse::make($expectedBody, 500)
    ]);

    $this->carbone->withMockClient($mockClient);

    $response = $this->carbone->getStatus();

    expect($response->failed())->toBeTrue();

    $exception = $response->toException();

    expect($exception)->toBeInstanceOf(CarboneSdkRequestException::class);
    expect($exception->getMessage())->toBe($expectedBody);
});

it('getResponse on CarboneSdkRequestException returns the original response', function () {
    $expectedBody = json_encode(["success" => false, "error" => "Internal Server Error"]);

    $mockClient = new MockClient([
        StatusRequest::class => MockResponse::make($expectedBody, 500)
    ]);

    $this->carbone->withMockClient($mockClient);

    $response = $this->carbone->getStatus();
    $exception = $response->toException();

    expect($exception)->toBeInstanceOf(CarboneSdkRequestException::class);
    expect($exception->getResponse()->status())->toBe(500);
    expect($exception->getResponse()->body())->toBe($expectedBody);
});
