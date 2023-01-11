<?php

namespace Carboneio\CarboneSdk\Requests\Reports;

/** Saloon */
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Clients\MockClient;
use Sammyjo20\Saloon\Traits\Plugins\HasJsonBody;
use Sammyjo20\Saloon\Http\SaloonRequest;

class RenderReport extends SaloonRequest
{
    use HasJsonBody;

    protected ?string $method = Saloon::POST;

    public function __construct(
        private string $templateId,
        private array $data
    ) {
    }

    public function defineEndpoint(): string
    {
        return '/render/' . $this->templateId;
    }

    public function defaultData(): array
    {
        return $this->data;
    }
}
