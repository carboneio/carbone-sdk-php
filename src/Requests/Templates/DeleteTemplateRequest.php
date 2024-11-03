<?php

namespace Carboneio\SDK\Requests\Templates;

/** Saloon Class */
use Saloon\Constants\Saloon;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;
use Saloon\Http\Request;
use Saloon\Enums\Method;

class DeleteTemplateRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::DELETE;

    public function __construct(
        private string $templateId
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/template/' . $this->templateId;
    }

}
