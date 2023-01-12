<?php

namespace Carboneio\SDK\Responses;

class RenderReportResponse extends CarboneSdkResponse
{
    public function getRenderId(): ?string
    {
        return $this->json('data.renderId');
    }
}
