<?php

namespace Assurdeal\SailHttps\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SslCheckController
{
    /**
     * Validate HTTPs domain with Caddy.
     */
    public function __invoke(Request $request): Response
    {
        if (in_array($request->query('domain'), config('sail-https.authorized_domains'))) {
            return response('Domain Authorized');
        }

        // Abort if there's no 200 response returned above
        abort(503);
    }
}
