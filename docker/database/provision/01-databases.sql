CREATE DATABASE IF NOT EXISTS `360_dev`;

CREATE USER '360_dev'@'localhost' IDENTIFIED BY 'FjXS3YN7';
GRANT ALL ON 360_dev.* TO '360_dev'@'%';

FLUSH PRIVILEGES;