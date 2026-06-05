<?php

namespace App\Services;

use App\Helpers\CodeGenerator;
use App\Repositories\UrlRepository;

class UrlShortenerService
{
    public function __construct(
        private UrlRepository $repository
    ) {}

    /**
     * Create short URL.
     */
    public function shorten(
        string $url
    ): array {

        // Reuse existing URL if already shortened
        $existing = $this->repository
            ->findByOriginalUrl($url);

        if ($existing) {
            return $existing;
        }

        do {
            $shortCode = CodeGenerator::generate(6);
        } while (
            $this->repository->codeExists($shortCode)
        );

        $this->repository->create(
            $url,
            $shortCode
        );

        return [
            'original_url' => $url,
            'short_code' => $shortCode,
        ];
    }

    /**
     * Resolve short code to original URL.
     */
    public function resolve(
        string $shortCode
    ): ?array {
        return $this->repository
            ->findByCode($shortCode);
    }
}