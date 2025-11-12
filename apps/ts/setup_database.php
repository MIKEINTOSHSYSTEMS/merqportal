<?php
/**
 * Database Setup Script for MERQ Timesheet System
 * Run this script once to create the required database tables
 */

require_once __DIR__ . '/config/database.php';

try {
    $pdo = getDBConnection();

    // Create projects table
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS projects (
            project_id INT AUTO_INCREMENT PRIMARY KEY,
            project_name VARCHAR(255) NOT NULL UNIQUE,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");

    // Create user_projects table
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS user_projects (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            project_id INT NOT NULL,
            year INT NOT NULL,
            month INT NOT NULL,
            allocated_hours DECIMAL(5,2) DEFAULT 0.00,
            total_hours DECIMAL(6,2) DEFAULT 0.00,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            UNIQUE KEY unique_user_project_month (user_id, project_id, year, month),
            FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
            FOREIGN KEY (project_id) REFERENCES projects(project_id) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");

    // Create project_hours table for detailed daily hours
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS project_hours (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            project_id INT NOT NULL,
            year INT NOT NULL,
            month INT NOT NULL,
            day INT NOT NULL,
            hours DECIMAL(4,2) DEFAULT 0.00,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            UNIQUE KEY unique_user_project_day (user_id, project_id, year, month, day),
            FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
            FOREIGN KEY (project_id) REFERENCES projects(project_id) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");

    // Insert default MERQ Internal project if it doesn't exist
    $stmt = $pdo->prepare("INSERT IGNORE INTO projects (project_name) VALUES (?)");
    $stmt->execute(['MERQ Internal']);

    echo "Database tables created successfully!\n";
    echo "Setup completed. You can now use the timesheet system.\n";

} catch (PDOException $e) {
    echo "Database setup failed: " . $e->getMessage() . "\n";
    exit(1);
}
?>