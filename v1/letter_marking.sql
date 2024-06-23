CREATE TABLE emp_id (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    middle_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    gen ENUM('Male', 'Female') NOT NULL,
    dob DATE NOT NULL,
    mobile_no INT NOT NULL,
    email_id VARCHAR(50) NOT NULL,
    cadre_id INT NOT NULL,
    desig_id INT NOT NULL,
    internal_desig_id INT NOT NULL,
    group_id INT NOT NULL,
    user_type ENUM('Admin', 'User') NOT NULL,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    status ENUM('1', '2') NOT NULL DEFAULT '1',
    is_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_deleted TIMESTAMP NULL
);
insert into emp_id values(1,"jane","doe","smith","Female","08-08-2001",912345678,"janesmith@gmail.com",102,202,2,200,"user","janesmith","password123","1");
CREATE TABLE groups (
    group_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ad_id VARCHAR(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
    gh_id VARCHAR(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
    group_name VARCHAR(20) COLLATE utf8mb4_general_ci DEFAULT NULL
);

ALTER TABLE emp_id
ADD CONSTRAINT fk_group_id
FOREIGN KEY (group_id) REFERENCES groups(group_id);
CREATE TABLE letters (
    letter_id INT AUTO_INCREMENT PRIMARY KEY,
    letter_mode VARCHAR(50),
    docket_number INT,
    docket_date DATE,
    category VARCHAR(50),
    letter_number VARCHAR(50),
    letter_date DATE,
    establishment_name VARCHAR(50),
    subject VARCHAR(255)
);
ALTER TABLE letters
ADD COLUMN file varchar(30);
alter table letters rename column file to filename;
ALTER TABLE emp_id ADD CONSTRAINT FOREIGN KEY (role_id) REFERENCES roles(role_id);