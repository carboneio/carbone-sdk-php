<?php

namespace Carboneio\SDK\RequestsCollection;

/** Saloon Abstracts */
use Sammyjo20\Saloon\Http\RequestCollection;

/** Requests */
use Carboneio\SDK\Requests\Templates\DeleteTemplateRequest;
use Carboneio\SDK\Requests\Templates\DownloadTemplateRequest;
use Carboneio\SDK\Requests\Templates\UploadTemplateRequest;

/** Responses */
use Carboneio\SDK\Responses\CarboneSdkResponse;
use Carboneio\SDK\Responses\UploadTemplateResponse;

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
