<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Crypt;

class EncryptDecryptMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Decrypt request data (if applicable)
        if ($request->has('encrypted_data')) {
            try {
                $decryptedData = Crypt::decrypt($request->input('encrypted_data'));
                $request->merge(['decrypted_data' => $decryptedData]);
            } catch (\Exception $e) {
                abort(400, 'Invalid encryption.');
            }
        }

        // Process the request and get the response
        $response = $next($request);

        // Encrypt response data (if applicable)
        if ($response->getContent()) {
            $encryptedContent = Crypt::encrypt($response->getContent());
            $response->setContent($encryptedContent);
        }

        return $response;
    }
}