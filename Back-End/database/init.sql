CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  phone VARCHAR(20),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO users (name, email, phone) VALUES
('Julio Cesar', 'julio@email.com', '99999-9999'),
('Ana Maria', 'ana@email.com', '98888-8888'),
('Carlos Silva', 'carlos@email.com', '97777-7777');
