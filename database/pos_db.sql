-- =====================================================
-- POS database (IT0049 TFA3: Forms, Validation, File Upload)
--
-- BEFORE importing, SELECT your database in the left sidebar of phpMyAdmin
-- (local: pos_db, InfinityFree: your if0_xxxxxxxx_... database).
-- Then go to the Import tab and choose this file.
-- =====================================================

DROP TABLE IF EXISTS customers;
DROP TABLE IF EXISTS users;

-- Customers: full name (required), email (required, valid)
CREATE TABLE customers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL
);

-- Users: username (required, unique), full name (required),
-- avatar = file name only (NULL when no picture was uploaded)
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  full_name VARCHAR(100) NOT NULL,
  avatar VARCHAR(255) NULL
);

-- Sample records
INSERT INTO customers (full_name, email) VALUES
('Craig Ongcoy', 'ongcoybeats@gmail.com'),
('Kyle Miranda', 'kylebombs@gmail.com'),
('Lebron James', 'LebronJamess@gmail.com'),
('Novak Djokovic', 'Novakgoat@gmail.com');

INSERT INTO users (username, full_name) VALUES
('admin', 'Store Administrator'),
('cashier1', 'Sydney Sweeney');

-- NOTE: If you already have a users table from TFA2 that you want to keep,
-- do NOT run the DROP/CREATE above. Run only this line instead:
-- ALTER TABLE users ADD avatar VARCHAR(255) NULL;
