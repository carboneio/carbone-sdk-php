<?php

namespace Carboneio\SDK\Requests;

/** Saloon Class */
use Saloon\Constants\Saloon;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;
use Saloon\Http\Request;
use Saloon\Enums\Method;

class StatusRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::GET;

    public function __construct() {
    }

    public function resolveEndpoint(): string
    {
        return '/status';
    }
}
