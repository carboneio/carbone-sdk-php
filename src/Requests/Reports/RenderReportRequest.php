<?php

namespace Carboneio\SDK\Requests\Reports;

/** Saloon */
use Saloon\Constants\Saloon;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;
use Saloon\Http\Request;
use Saloon\Enums\Method;

/** Carbone SDK Class */
use Carboneio\SDK\Responses\RenderReportResponse;

class RenderReportRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    protected ?string $response = RenderReportResponse::class;

    public function __construct(
        private string $templateId,
        private array $data
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/render/' . $this->templateId;
    }

    public function defaultBody(): array
    {
        return $this->data;
    }
}
