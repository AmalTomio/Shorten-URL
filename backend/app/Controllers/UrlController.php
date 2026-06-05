<?php

namespace App\Controllers;

use App\Core\Response;
use App\Services\UrlShortenerService;

class UrlController
{
    public function __construct(
        private UrlShortenerService $service
    ) {}

    /**
     * POST /api/shorten
     */
    public function shorten(): void
    {
        $body = json_decode(
            file_get_contents('php://input'),
            true
        );

        $url = trim($body['url'] ?? '');

        /**
         * Validation
         */
        if (empty($url)) {
            Response::json([
                'success' => false,
                'message' => 'URL is required'
            ], 422);
        }

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            Response::json([
                'success' => false,
                'message' => 'Invalid URL'
            ], 422);
        }

        $result = $this->service
            ->shorten($url);

        Response::json([
            'success' => true,
            'shortCode' => $result['short_code'],
            'shortUrl' => $_ENV['APP_URL'] . '/' . $result['short_code']
        ]);
    }

    /**
     * GET /{code}
     */
    public function redirect(
        string $code
    ): void {
        $url = $this->service
            ->resolve($code);

        if (!$url) {
            http_response_code(404);

            echo 'Short URL not found';

            exit;
        }

        header(
            'Location: ' . $url['original_url'],
            true,
            302,
        );

        exit;
    }
}