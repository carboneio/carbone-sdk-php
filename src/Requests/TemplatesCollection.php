<?php

namespace Carboneio\CarboneSdk\RequestsCollection;

/** Saloon Abstracts */
use Sammyjo20\Saloon\Http\RequestCollection;

/** Requests */
use Carboneio\CarboneSdk\Requests\Templates\DeleteTemplate;
use Carboneio\CarboneSdk\Requests\Templates\DownloadTemplate;
use Carboneio\CarboneSdk\Requests\Templates\UploadTemplate;

/** Responses */
use Carboneio\CarboneSdk\Responses\CarboneSdkResponse;
use Carboneio\CarboneSdk\Responses\UploadTemplateResponse;

class TemplatesCollection extends RequestCollection
{
    public function upload(string $content): UploadTemplateResponse
    {
        return (new UploadTemplate($content))
            ->setConnector($this->connector)
            ->send();
    }

    public function delete(string $templateId): CarboneSdkResponse
    {
        return (new DeleteTemplate($templateId))
            ->setConnector($this->connector)
            ->send();
    }

    public function download(string $templateId): CarboneSdkResponse
    {
        return (new DownloadTemplate($templateId))
            ->setConnector($this->connector)
            ->send();
    }
}
