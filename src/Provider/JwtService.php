<?php

namespace App\Provider;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

abstract class JwtService
{
    /**
     *  @inheritDoc
     * 
     */
    static function EncodeJwt(array $payload): bool|string
    {

        try {
            $encoded = JWT::encode($payload, $_ENV['JWT_SECRET'] ?? '', 'HS256');
        } catch (\Throwable $th) {
            throw ($th);
            $encoded = false;
        }
        return $encoded;
    }

    /**
     *  @inheritDoc
     * 
     */
    static function Decode(string $token): array|bool
    {
        try {
            $jwt_data = json_decode(json_encode(
                JWT::decode(
                    $token,
                    new Key($_ENV['JWT_SECRET'] ?? '', 'HS256')
                )
            ),true);
        } catch (\Throwable $th) {
            // throw ($th);
            $jwt_data = false;
        }
        return $jwt_data;
    }


}