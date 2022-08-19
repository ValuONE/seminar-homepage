CREATE TABLE IF NOT EXISTS users(
    uid int(255) PRIMARY KEY AUTO_INCREMENT,
    username varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    created_at varchar(255) NOT NULL,
    verified_at boolean NOT NULL
);

ALTER TABLE users AUTO_INCREMENT = 1;

CREATE TABLE IF NOT EXISTS blog(
    bid int(255) PRIMARY KEY AUTO_INCREMENT,
    title varchar(255),
    content varchar(5000),
    author varchar(255),
    created_at varchar(255),
    filename varchar(255)
);

ALTER TABLE blog AUTO_INCREMENT = 1;