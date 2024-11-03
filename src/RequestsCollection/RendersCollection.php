<?php

namespace Carboneio\SDK\RequestsCollection;

/** Requests */
use Carboneio\SDK\Requests\Reports\RenderReportRequest;
use Carboneio\SDK\Requests\Reports\DownloadReportRequest;

/** Responses */
use Carboneio\SDK\Responses\CarboneSdkResponse;
use Carboneio\SDK\Responses\RenderReportResponse;

use Saloon\Repositories\RequestCollection;
use Saloon\Http\Connector;

class RendersCollection
{
    protected Connector $connector;

    public function __construct(Connector $connector)
    {
        $this->connector = $connector;
    }

    public function render(string $templateId, array $data): RenderReportResponse
    {
        return $this->connector->send(new RenderReportRequest($templateId, $data));
    }

    public function download(string $renderId): CarboneSdkResponse
    {
        return $this->connector->send(new DownloadReportRequest($renderId));
    }
}

