<?php

namespace App\Repositories;

use PDO;

class UrlRepository
{
    public function __construct(
        private PDO $db
    ) {}

    /**
     * Create a new short URL record.
     */
    public function create(
        string $originalUrl,
        string $shortCode
    ): bool {
        $stmt = $this->db->prepare("
            INSERT INTO urls (
                original_url,
                short_code
            )
            VALUES (
                :original_url,
                :short_code
            )
        ");

        return $stmt->execute([
            'original_url' => $originalUrl,
            'short_code' => $shortCode,
        ]);
    }

    /**
     * Find URL by short code.
     */
    public function findByCode(
        string $shortCode
    ): ?array {
        $stmt = $this->db->prepare("
            SELECT *
            FROM urls
            WHERE short_code = :short_code
            LIMIT 1
        ");

        $stmt->execute([
            'short_code' => $shortCode,
        ]);

        $result = $stmt->fetch();

        return $result ?: null;
    }

    /**
     * Find existing URL.
     */
    public function findByOriginalUrl(
        string $originalUrl
    ): ?array {
        $stmt = $this->db->prepare("
            SELECT *
            FROM urls
            WHERE original_url = :original_url
            LIMIT 1
        ");

        $stmt->execute([
            'original_url' => $originalUrl,
        ]);

        $result = $stmt->fetch();

        return $result ?: null;
    }

    /**
     * Check whether short code already exists.
     */
    public function codeExists(
        string $shortCode
    ): bool {
        $stmt = $this->db->prepare("
            SELECT id
            FROM urls
            WHERE short_code = :short_code
            LIMIT 1
        ");

        $stmt->execute([
            'short_code' => $shortCode,
        ]);

        return (bool) $stmt->fetch();
    }
}