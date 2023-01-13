<?php

namespace Carboneio\SDK;

/** Carboneio SDK Class */
use Carboneio\SDK\Responses\CarboneSdkResponse;

/** Carbone SDK Collections */
use Carboneio\SDK\RequestsCollection\RendersCollection;
use Carboneio\SDK\RequestsCollection\TemplatesCollection;
use Carboneio\SDK\Requests\StatusRequest;

/** Saloon Class */
use Sammyjo20\Saloon\Http\SaloonConnector;
use Sammyjo20\Saloon\Traits\Plugins\AcceptsJson;
use Sammyjo20\Saloon\Http\Auth\TokenAuthenticator;
use Sammyjo20\Saloon\Http\SaloonResponse;
use Sammyjo20\Saloon\Interfaces\AuthenticatorInterface;

class Carbone extends SaloonConnector
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
        'renders' => RendersCollection::class
    ];

    /**
     * Define the base URL of the API.
     *
     * @return string
     */
    public function defineBaseUrl(): string
    {
        return $this->apiBaseUrl;
    }

    /**
     * @param string|null $baseUrl
     */
    public function __construct(private string $token, string $baseUrl = null)
    {
        if (isset($baseUrl)) {
            $this->apiBaseUrl = $baseUrl;
        }
    }

    public function defaultAuth(): ?AuthenticatorInterface
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
            'timeout' => 30
        ];
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getStatus(): SaloonResponse
    {
        return $this->request(new StatusRequest())->send();
    }
}
