<?php

namespace Carboneio\SDK\Responses;

/** Saloon Class */
use Sammyjo20\Saloon\Http\SaloonResponse;

/** Carbone Class */
use Carboneio\SDK\Exceptions\CarboneSdkRequestException;

class CarboneSdkResponse extends SaloonResponse
{
    /**
     * Create an exception if a server or client error occurred.
     *
     * @return CarboneSdkRequestException
     */
    public function toException(): CarboneSdkRequestException
    {
        if ($this->failed()) {
            $body = $this->response?->getBody()?->getContents();

            return new CarboneSdkRequestException($this, $body, 0, $this->getGuzzleException());
        }
    }
}
