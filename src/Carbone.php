<?php

namespace Carboneio\SDK;

/** Carboneio SDK Class */
use Saloon\Http\Response;

/** Carbone SDK Collections */
use Saloon\Http\Connector;
use Saloon\Contracts\Authenticator;
use Saloon\Traits\Plugins\AcceptsJson;

/** Saloon Class */
use Saloon\Http\Auth\TokenAuthenticator;
use Carboneio\SDK\Requests\StatusRequest;
use Carboneio\SDK\Responses\CarboneSdkResponse;
use Carboneio\SDK\RequestsCollection\RendersCollection;
use Carboneio\SDK\RequestsCollection\TemplatesCollection;

class Carbone extends Connector
{
    use AcceptsJson;

    /**
     * Define the base URL for the API
     *
     * @var string
     */
    protected string $apiBaseUrl = 'https://api.carbone.io/';

    /**
     * Custom response that all requests will return.
     *
     * @var string|null
     */
    protected ?string $response = CarboneSdkResponse::class;

    /**
     * The requests/services on the CarboneSdk.
     *
     * @var array
     */
    protected array $requests = [
        'templates' => TemplatesCollection::class,
        'renders' => RendersCollection::class,
    ];

    /**
     * Define the base URL of the API.
     *
     * @return string
     */
    public function resolveBaseUrl(): string
    {
        return $this->apiBaseUrl;
    }

    /**
     * @param string|null $baseUrl
     */
    public function __construct(private string $token, ?string $baseUrl = null)
    {
        if (isset($baseUrl)) {
            $this->apiBaseUrl = $baseUrl;
        }
    }

    public function defaultAuth(): ?Authenticator
    {
        return new TokenAuthenticator($this->token);
    }

    /**
     * Define any default headers.
     *
     * @return array
     */
    public function defaultHeaders(): array
    {
        return [
            'carbone-version' => '4',
            'Content-Type' => 'application/json',
        ];
    }

    /**
     * Define any default config.
     *
     * @return array
     */
    public function defaultConfig(): array
    {
        return [
            'timeout' => 30,
        ];
    }

    public function templates(): TemplatesCollection
    {
        return new TemplatesCollection($this);
    }

    public function renders(): RendersCollection
    {
        return new RendersCollection($this);
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getStatus(): Response
    {
        return $this->send(new StatusRequest());
    }
}
