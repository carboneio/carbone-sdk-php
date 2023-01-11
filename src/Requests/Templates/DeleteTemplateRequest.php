<?php

namespace Carboneio\CarboneSdk\Requests\Templates;

/** Saloon Class */
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Traits\Plugins\HasJsonBody;
use Sammyjo20\Saloon\Http\SaloonRequest;

class DeleteTemplateRequest extends SaloonRequest
{
    use HasJsonBody;

    protected ?string $method = Saloon::DELETE;

    public function __construct(
        private string $templateId
    ) {
    }

    public function defineEndpoint(): string
    {
        return '/template/' . $this->templateId;
    }

}
