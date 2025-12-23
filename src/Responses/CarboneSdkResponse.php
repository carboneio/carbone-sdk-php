<?php

namespace Carboneio\SDK\Responses;

/** Saloon Class */
use Saloon\Http\Response;

/** Carbone Class */
use Carboneio\SDK\Exceptions\CarboneSdkRequestException;

class CarboneSdkResponse extends Response
{
    /**
     * Create an exception if a server or client error occurred.
     *
     * @return CarboneSdkRequestException|null
     */
    public function toException(): ?CarboneSdkRequestException
    {
        if ($this->failed()) {
            $body = $this->response?->getBody()?->getContents();

            return new CarboneSdkRequestException($this, $body, 0, $this->getGuzzleException());
        }

        return null;
    }
}
