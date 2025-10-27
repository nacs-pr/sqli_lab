-- Use the database we created in the 'environment' section
USE webapp;

-- Create the table for Lab 1
CREATE TABLE users (
  id INT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(50),
  password VARCHAR(50),
  role VARCHAR(20)
);

-- Insert the data for Lab 1
INSERT INTO users (username, password, role) VALUES
('admin', 'complexP@ssw0rd!', 'admin'),
('alice', 'alice123', 'user'),
('bob', 'bobPass', 'user');

-- Create the table for Lab 2
CREATE TABLE articles (
  id INT PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(100),
  content TEXT,
  author_id INT
);

-- Insert the data for Lab 2
INSERT INTO articles (title, content, author_id) VALUES
('Welcome', 'This is a test article.', 2),
('Security', 'Security is important.', 1);