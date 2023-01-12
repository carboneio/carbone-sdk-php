<?php

namespace Carboneio\SDK\RequestsCollection;

/** Saloon Abstracts */
use Sammyjo20\Saloon\Http\RequestCollection;

/** Requests */
use Carboneio\SDK\Requests\Reports\RenderReportRequest;
use Carboneio\SDK\Requests\Reports\DownloadReportRequest;

/** Responses */
use Carboneio\SDK\Responses\CarboneSdkResponse;
use Carboneio\SDK\Responses\RenderReportResponse;

class RendersCollection extends RequestCollection
{
    public function render(string $templateId, array $data): RenderReportResponse
    {
        return (new RenderReportRequest($templateId, $data))
            ->setConnector($this->connector)
            ->send();
    }

    public function download(string $renderId): CarboneSdkResponse
    {
        return (new DownloadReportRequest($renderId))
            ->setConnector($this->connector)
            ->send();
    }
}

