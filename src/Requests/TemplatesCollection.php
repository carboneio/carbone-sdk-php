<?php

namespace Carboneio\CarboneSdk\RequestsCollection;

/** Saloon Abstracts */
use Sammyjo20\Saloon\Http\RequestCollection;

/** Requests */
use Carboneio\CarboneSdk\Requests\Templates\DeleteTemplateRequest;
use Carboneio\CarboneSdk\Requests\Templates\DownloadTemplateRequest;
use Carboneio\CarboneSdk\Requests\Templates\UploadTemplateRequest;

/** Responses */
use Carboneio\CarboneSdk\Responses\CarboneSdkResponse;
use Carboneio\CarboneSdk\Responses\UploadTemplateResponse;

class TemplatesCollection extends RequestCollection
{
    public function upload(string $content): UploadTemplateResponse
    {
        return (new UploadTemplateRequest($content))
            ->setConnector($this->connector)
            ->send();
    }

    public function delete(string $templateId): CarboneSdkResponse
    {
        return (new DeleteTemplateRequest($templateId))
            ->setConnector($this->connector)
            ->send();
    }

    public function download(string $templateId): CarboneSdkResponse
    {
        return (new DownloadTemplateRequest($templateId))
            ->setConnector($this->connector)
            ->send();
    }
}
