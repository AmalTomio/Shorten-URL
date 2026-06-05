CREATE DATABASE IF NOT EXISTS shortener;

USE shortener;

CREATE TABLE urls (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    original_url TEXT NOT NULL,

    short_code VARCHAR(8) NOT NULL UNIQUE,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    INDEX idx_short_code (short_code)
);