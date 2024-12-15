DROP DATABASE IF EXISTS BogaDev;
CREATE DATABASE BogaDev;
Use BogaDev;

DROP TABLE IF EXISTS student;


CREATE TABLE student (
    studentname VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    registrationNo VARCHAR(255) NOT NULL,
    course VARCHAR(200) NOT NULL,
    department VARCHAR(200) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );


INSERT INTO student (studentname, email, registrationNo, course, department) VALUES
('Harvey', 'harvey.specter@example.com', '0000000', 'Cybersecurity', 'Engineering'),
('Donna', 'donna.paulsen@example.com', '0000000', 'Cybersecurity', 'Engineering'),
('Mike', 'mike.ross@example.com', '0000000', 'DevOps', 'Engineering'),
('Zane', 'zane.specter@example.com', '0000000', 'Web Technology', 'ICT'),
('Alex', 'alex.williams@example.com', '0000000', 'Web Technology', 'ICT');

