<?php

namespace Carboneio\SDK\RequestsCollection;

/** Requests */

use Saloon\Http\Connector;
use Carboneio\SDK\Responses\CarboneSdkResponse;
use Carboneio\SDK\Responses\RenderReportResponse;

/** Responses */
use Carboneio\SDK\Requests\Reports\RenderReportRequest;
use Carboneio\SDK\Requests\Reports\DownloadReportRequest;

use Carboneio\SDK\Requests\Reports\RenderAndDownloadReportRequest;

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

    public function renderAndDownload(string $templateId, array $data): CarboneSdkResponse
    {
        return $this->connector->send(new RenderAndDownloadReportRequest($templateId, $data));
    }
}
