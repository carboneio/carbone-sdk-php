<?php

namespace Carboneio\SDK\Requests;

/** Saloon Class */
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Traits\Plugins\HasJsonBody;
use Sammyjo20\Saloon\Http\SaloonRequest;

class StatusRequest extends SaloonRequest
{
    use HasJsonBody;

    protected ?string $method = Saloon::GET;

    public function __construct() {
    }

    public function defineEndpoint(): string
    {
        return '/status';
    }
}
