<?php

namespace Carboneio\CarboneSdk\Requests\Templates;

/** Saloon Class */
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Traits\Plugins\HasJsonBody;
use Sammyjo20\Saloon\Http\SaloonRequest;

class DownloadTemplate extends SaloonRequest
{
    use HasJsonBody;

    protected ?string $method = Saloon::GET;

    public function __construct(
        private string $templateId
    ) {
    }

    public function defineEndpoint(): string
    {
        return '/template/' . $this->templateId;
    }

}
