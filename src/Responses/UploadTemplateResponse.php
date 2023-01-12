<?php

namespace Carboneio\SDK\Responses;

class UploadTemplateResponse extends CarboneSdkResponse
{
    public function getTemplateId(): ?string
    {
        return $this->json('data.templateId');
    }
}
