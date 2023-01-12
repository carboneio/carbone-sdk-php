<?php

namespace Carboneio\SDK\Requests\Templates;

/** Saloon Class */
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Traits\Plugins\HasJsonBody;
use Sammyjo20\Saloon\Http\SaloonRequest;

/** Carbone SDK Class */
use Carboneio\SDK\Responses\UploadTemplateResponse;

class UploadTemplateRequest extends SaloonRequest
{
    use HasJsonBody;

    protected ?string $method = Saloon::POST;

    protected ?string $response = UploadTemplateResponse::class;

    public function __construct(
        private string $templateAsBase64
    ) {
    }

    public function defineEndpoint(): string
    {
        return '/template';
    }

    public function defaultData(): array
    {
        return [
            'template' => $this->templateAsBase64,
        ];
    }
}
