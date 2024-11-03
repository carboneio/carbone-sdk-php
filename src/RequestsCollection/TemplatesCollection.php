<?php

namespace Carboneio\SDK\RequestsCollection;

/** Requests */
use Carboneio\SDK\Requests\Templates\DeleteTemplateRequest;
use Carboneio\SDK\Requests\Templates\DownloadTemplateRequest;
use Carboneio\SDK\Requests\Templates\UploadTemplateRequest;

/** Responses */
use Carboneio\SDK\Responses\CarboneSdkResponse;
use Carboneio\SDK\Responses\UploadTemplateResponse;

use Saloon\Repositories\RequestCollection;
use Saloon\Http\Connector;

class TemplatesCollection
{
    protected Connector $connector;

    public function __construct(Connector $connector)
    {
        $this->connector = $connector;
    }

    public function upload(string $content): UploadTemplateResponse
    {
        return $this->connector->send(new UploadTemplateRequest($content));
    }

    public function delete(string $templateId): CarboneSdkResponse
    {
        return $this->connector->send(new DeleteTemplateRequest($templateId));
    }

    public function download(string $templateId): CarboneSdkResponse
    {
        return $this->connector->send(new DownloadTemplateRequest($templateId));
    }
}
