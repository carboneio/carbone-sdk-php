<?php

namespace Carboneio\CarboneSdk\Requests\Templates;

/** Saloon Class */
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Traits\Plugins\HasJsonBody;
use Sammyjo20\Saloon\Http\SaloonRequest;

class UploadTemplate extends SaloonRequest
{
    use HasJsonBody;

    protected ?string $method = Saloon::POST;

    public function __construct(
        private string $content
    ) {
    }

    public function defineEndpoint(): string
    {
        return '/template';
    }

    public function defaultData(): array
    {
        return [
            'template' => $this->content,
        ];
    }
}
