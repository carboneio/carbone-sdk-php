<?php

namespace Carboneio\CarboneSdk\Responses;

use Sammyjo20\Saloon\Http\SaloonResponse;
use Carboneio\CarboneSdk\Exceptions\CarboneSdkRequestException;

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
