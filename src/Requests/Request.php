<?php

namespace Carboneio\CarboneSdk\Requests;

use Carboneio\CarboneSdk\CarboneSdk;
use Sammyjo20\Saloon\Http\SaloonRequest;

class Request extends SaloonRequest
{
    /**
     * @var string|null
     */
    protected ?string $connector = CarboneSdk::class;
}
