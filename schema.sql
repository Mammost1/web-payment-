-- Schema for the login table. Run once: mysql -u <user> -p < schema.sql
CREATE DATABASE IF NOT EXISTS login_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE login_db;

CREATE TABLE IF NOT EXISTS login (
    id            INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username      VARCHAR(50)  NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    phone_number  VARCHAR(20)  NOT NULL,
    email         VARCHAR(255) NOT NULL,
    created_at    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
