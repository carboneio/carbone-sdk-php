<?php

namespace Carboneio\CarboneSdk\Responses;

class UploadTemplateResponse extends CarboneSdkResponse
{
    public function getTemplateId(): ?string
    {
        return $this->json('data.templateId');
    }
}
