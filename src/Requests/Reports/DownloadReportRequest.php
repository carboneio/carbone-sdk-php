<?php

namespace Carboneio\CarboneSdk\Requests\Reports;

/** Saloon Class */
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Traits\Plugins\HasJsonBody;
use Sammyjo20\Saloon\Http\SaloonRequest;

class DownloadReportRequest extends SaloonRequest
{
    use HasJsonBody;

    protected ?string $method = Saloon::GET;

    public function __construct(
        private string $renderId,
    ) {
    }

    public function defineEndpoint(): string
    {
        return '/render/' . $this->renderId;
    }

}
