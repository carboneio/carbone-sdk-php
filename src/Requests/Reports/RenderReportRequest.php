<?php

namespace Carboneio\SDK\Requests\Reports;

/** Saloon */
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Traits\Plugins\HasJsonBody;
use Sammyjo20\Saloon\Http\SaloonRequest;

/** Carbone SDK Class */
use Carboneio\SDK\Responses\RenderReportResponse;

class RenderReportRequest extends SaloonRequest
{
    use HasJsonBody;

    protected ?string $method = Saloon::POST;

    protected ?string $response = RenderReportResponse::class;

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
