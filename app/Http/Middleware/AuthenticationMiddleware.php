<?php


namespace App\Http\Middleware;


use App\Exceptions\InvalidTokenException;
use App\Services\TokenService;
use Closure;

class AuthenticationMiddleware
{
    private $tokenService;

    /**
     * AuthenticationMiddleware constructor.
     * @param $tokenService
     */
    public function __construct(TokenService $tokenService)
    {
        $this->tokenService = $tokenService;
    }

    public function handle($request, Closure $next)
    {
        if (is_null($request->bearerToken())) {
            throw new InvalidTokenException('Missing bearer token');
        }

        try {
            $decodedToken = $this->tokenService->decodeToken($request->bearerToken());
            if ($decodedToken->type === "user") {
                $request->merge(['user_id' => $decodedToken->aud]);
                return $next($request);
            }
            $request->merge(['vendor_id' => $decodedToken->aud]);
            return $next($request);
        } catch (InvalidTokenException $e) {
            throw new InvalidTokenException($e->getMessage());
        }

    }


}
