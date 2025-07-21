<?php

namespace Carboneio\SDK\Requests\Reports;

/** Saloon */
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Constants\Saloon;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;

/** Carbone SDK Class */

class RenderAndDownloadReportRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

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

    protected function defaultQuery(): array
    {
        return [
            'download' => 'true',
        ];
    }
}
