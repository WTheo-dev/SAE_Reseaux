CREATE USER IF NOT EXISTS 'root'@'localhost' IDENTIFIED BY 'root';
CREATE USER IF NOT EXISTS 'utilisateur'@'localhost' IDENTIFIED BY 'password';
CREATE USER IF NOT EXISTS 'maxlamenace'@'localhost' IDENTIFIED BY 'hamza';
CREATE DATABASE IF NOT EXISTS apeaj
CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
GRANT ALL PRIVILEGES ON apeaj .* TO 'maxlamenace'@'localhost';
FLUSH PRIVILEGES;

