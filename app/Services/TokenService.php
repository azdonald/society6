<?php


namespace App\Services;


use App\Exceptions\InvalidTokenException;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\SignatureInvalidException;

class TokenService
{
    public function generateToken(int $id, string $type): string
    {
        $payload = [
            'iss' => "society6",
            'aud' => $id,
            'iat' => time(),
            'type' => $type,
            'nbf' => time(),
            'exp' => time() + 490 * 30
        ];

        return JWT::encode($payload,  env('JWT_SECRET'));
    }

    public function decodeToken(string $token)
    {
        try {
            return JWT::decode($token, env('JWT_SECRET'), ['HS256']);
        }catch (ExpiredException | SignatureInvalidException | BeforeValidException $e) {
            throw new InvalidTokenException($e->getMessage());
        }
    }
}
