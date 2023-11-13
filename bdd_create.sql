CREATE USER IF NOT EXISTS 'utilisateur'@'localhost' IDENTIFIED BY 'password';
CREATE DATABASE IF NOT EXISTS apeaj
CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
GRANT ALL PRIVILEGES ON apeaj .* TO 'utilisateur'@'localhost';
FLUSH PRIVILEGES;