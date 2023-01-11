<?php

namespace Carboneio\CarboneSdk\RequestsCollection;

/** Saloon Abstracts */
use Sammyjo20\Saloon\Http\RequestCollection;

/** Requests */
use Carboneio\CarboneSdk\Requests\Reports\RenderReportRequest;
use Carboneio\CarboneSdk\Requests\Reports\DownloadReportRequest;

/** Responses */
use Carboneio\CarboneSdk\Responses\CarboneSdkResponse;
use Carboneio\CarboneSdk\Responses\RenderReportResponse;

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

