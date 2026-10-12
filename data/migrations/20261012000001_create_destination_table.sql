CREATE TABLE destination (
    destination_id INT AUTO_INCREMENT PRIMARY KEY,
    destination_user_id INT NOT NULL,
    destination_placename VARCHAR(255) NOT NULL,
    destination_created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    destination_updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (destination_user_id) REFERENCES user(user_id) ON DELETE CASCADE
);
