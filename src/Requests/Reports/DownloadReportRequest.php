<?php

namespace Carboneio\SDK\Requests\Reports;

/** Saloon Class */
use Saloon\Constants\Saloon;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;
use Saloon\Http\Request;
use Saloon\Enums\Method;

class DownloadReportRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::GET;

    public function __construct(
        private string $renderId,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return '/render/' . $this->renderId;
    }

}
