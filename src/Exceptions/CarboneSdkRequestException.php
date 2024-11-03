<?php

namespace Carboneio\SDK\Exceptions;

use Saloon\Http\Response;
use Saloon\Exceptions\Request\RequestException;

class CarboneSdkRequestException extends RequestException
{
    /**
     * Retrieve the response.
     *
     * @return SaloonResponse
     */
    public function getResponse(): Response
    {
        return $this->getSaloonResponse();
    }
}
