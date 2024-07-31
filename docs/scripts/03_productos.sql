
CREATE TABLE productos(  
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'Primary Key',
    name VARCHAR(255),
    price DECIMAL(10,2),
    stock INT,
    status CHAR(3) DEFAULT 'ACT',
    create_time DATETIME COMMENT 'Create Time'
) COMMENT '';