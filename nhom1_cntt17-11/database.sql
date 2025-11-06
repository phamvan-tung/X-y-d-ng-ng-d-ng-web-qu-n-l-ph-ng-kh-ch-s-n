-- Database Quảng Xương Resort
CREATE DATABASE IF NOT EXISTS quangxuong_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE quangxuong_db;

CREATE TABLE staff (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin','staff') DEFAULT 'staff',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE rooms (
  id INT AUTO_INCREMENT PRIMARY KEY,
  room_name VARCHAR(191) NOT NULL,
  room_type VARCHAR(100),
  price INT NOT NULL DEFAULT 0,
  status ENUM('available','booked','maintenance') DEFAULT 'available',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE customers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(191) NOT NULL,
  phone VARCHAR(60),
  email VARCHAR(191),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE bookings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  customer_name VARCHAR(191) NOT NULL,
  phone VARCHAR(60),
  room_id INT,
  check_in DATE,
  check_out DATE,
  status VARCHAR(50) DEFAULT 'pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- seed admin (password plain 'admin')
INSERT INTO staff (username, password, role) VALUES ('admin', 'admin', 'admin');

-- sample rooms
INSERT INTO rooms (room_name, room_type, price, status) VALUES
('Phòng Superior 101', 'Superior', 500000, 'available'),
('Phòng Deluxe 201', 'Deluxe', 800000, 'available');
