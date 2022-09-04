DROP DATABASE IF EXISTS myschool;
CREATE DATABASE myschool;
USE myschool;

CREATE TABLE users (
id 		 		INT NOT NULL,
nome 		 		VARCHAR(255) NOT NULL,
email 			VARCHAR(255) NOT NULL,
birth	    		DATE NOT NULL,
phone 	 		VARCHAR(15) NOT NULL,
passwordUser	VARCHAR(255) NOT NULL,
nivel          CHAR(1) NOT NULL DEFAULT 'U',
confirmed		INT NOT NULL,
token 			VARCHAR(32) NOT NULL,
PRIMARY KEY (id)
);

INSERT INTO users (id, nome, email, birth, phone, passwordUser, nivel, confirmed) VALUES 
(12345, 'teste', 'teste@local.com', '2000-02-20', '99-999999', '123456', 'U', 0);

INSERT INTO users (id, nome, email, birth, phone, passwordUser, nivel, confirmed) VALUES 
(123456, 'admin', 'admin@local.com', '2000-02-20', '99-999999', '123456', 'A', 0);

INSERT INTO users (id, nome, email, birth, phone, passwordUser, nivel, confirmed) VALUES 
(1234567, 'eder', 'login@local.com', '2000-02-20', '99-999999', '123456', 'A', 0);

SELECT * from users;

CREATE TABLE teacher (
teacher_id 		 INT NOT NULL,
teacher_name 	 VARCHAR(255) NOT NULL,
teacher_email   VARCHAR(255) NOT NULL,
teacher_birth   DATE NOT NULL,
teacher_phone   VARCHAR(15) NOT NULL,
teacher_password VARCHAR(255) NOT NULL,
token VARCHAR(32) NOT NULL, 
PRIMARY KEY (teacher_id)
);
