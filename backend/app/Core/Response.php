<?php

namespace App\Core;

class Response
{
    /**
     * Return JSON response.
     */
    public static function json(
        array $data,
        int $statusCode = 200
    ): void {
        http_response_code($statusCode);

        header('Content-Type: application/json');

        echo json_encode(
            $data,
            JSON_UNESCAPED_SLASHES
        );

        exit;
    }
}