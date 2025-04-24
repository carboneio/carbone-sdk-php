<?php

namespace Carboneio\SDK\Requests\Templates;

/** Saloon Class */
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Constants\Saloon;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;

/** Carbone SDK Class */
use Carboneio\SDK\Responses\UploadTemplateResponse;

class UploadTemplateRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    protected ?string $response = UploadTemplateResponse::class;

    public function __construct(
        private string $templateAsBase64
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/template';
    }

    public function defaultBody(): array
    {
        return [
            'template' => $this->templateAsBase64,
        ];
    }
}
