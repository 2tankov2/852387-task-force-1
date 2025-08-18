DROP DATABASE if exists taskforce;

CREATE DATABASE taskForce
    DEFAULT CHARACTER SET utf8mb4
    DEFAULT COLLATE utf8mb4_general_ci;

USE taskforce;

CREATE TABLE location (
    id INT unsigned NOT NULL AUTO_INCREMENT,
    city VARCHAR(125),
    coordinate_lat DECIMAL(10, 8),
    coordinate_long DECIMAL(10, 8),

    PRIMARY KEY (id)
) ENGINE=INNODB;

CREATE TABLE user (
    id INT unsigned NOT NULL AUTO_INCREMENT,
    role INT NOT NULL, -- 1 === заказчик / 2 === исполнитель
    status BOOLEAN NOT NULL, -- занят над задачей/свободен( TRUE / FALSE)
    date_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    avatar_url VARCHAR(255),
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    birthday DATE NOT NULL,
    phone VARCHAR(255),
    telegram VARCHAR(255),
    info VARCHAR(255),
    password VARCHAR(64),
    location_id INT unsigned,
    fail_count INT,
    hide_contacts BOOLEAN NOT NULL, -- СКРЫТЬ КОНТАКТЫ TRUE / FALSE

    PRIMARY KEY (id),

    FOREIGN KEY (location_id)
        REFERENCES location(id)
) ENGINE=INNODB;

CREATE TABLE skills (
    id INT unsigned NOT NULL AUTO_INCREMENT,
    name VARCHAR(64),
    worker_id INT unsigned NOT NULL,

    PRIMARY KEY (id),

    FOREIGN KEY (worker_id)
        REFERENCES user(id)
) ENGINE=INNODB;

CREATE TABLE categories (
    id INT unsigned NOT NULL AUTO_INCREMENT,
    title VARCHAR(125),

    PRIMARY KEY (id)
) ENGINE=INNODB;

CREATE TABLE status (
    id INT unsigned NOT NULL AUTO_INCREMENT,
    title varchar(125),

    PRIMARY KEY (id)
) ENGINE=INNODB;

CREATE TABLE tasks (
    id INT unsigned NOT NULL AUTO_INCREMENT,
    owner_id INT unsigned NOT NULL,
    worker_id INT unsigned NOT NULL,
    status_id INT unsigned NOT NULL,
    category_id INT unsigned NOT NULL,
    title VARCHAR(125) NOT NULL,
    date_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_complete DATE,
    info VARCHAR(255) NOT NULL,
    location_id INT unsigned,
    coordinate_lat DECIMAL(10, 8),
    coordinate_long DECIMAL(10, 8),
    price INT,

    PRIMARY KEY (id),

    FOREIGN KEY (owner_id)
        REFERENCES user(id),
    FOREIGN KEY (worker_id)
        REFERENCES user(id),
    FOREIGN KEY (status_id)
        REFERENCES status(id),
    FOREIGN KEY (category_id)
        REFERENCES categories(id),
    FOREIGN KEY (location_id)
        REFERENCES location(id)
) ENGINE=InnoDB;

CREATE TABLE files (
    id INT unsigned NOT NULL AUTO_INCREMENT,
    file_url VARCHAR(125),
    task_id INT unsigned NOT NULL,

    PRIMARY KEY (id),
    FOREIGN KEY (task_id)
        REFERENCES tasks(id)
) ENGINE=INNODB;

CREATE TABLE reviews (
    id INT unsigned NOT NULL AUTO_INCREMENT,
    owner_id INT unsigned NOT NULL,
    worker_id INT unsigned NOT NULL,
    task_id INT unsigned NOT NULL,
    comment VARCHAR(255) NOT NULL,
    score INT unsigned NOT NULL,

    PRIMARY KEY (id),
    FOREIGN KEY (owner_id)
        REFERENCES user(id),
    FOREIGN KEY (worker_id)
        REFERENCES user(id),
    FOREIGN KEY (task_id)
        REFERENCES tasks(id)
) ENGINE=INNODB;

CREATE TABLE responses (
    id INT unsigned NOT NULL AUTO_INCREMENT,
    worker_id INT unsigned NOT NULL,
    task_id INT unsigned NOT NULL,
    price INT NOT NULL,
    comment VARCHAR(255),

    PRIMARY KEY (id),

    FOREIGN KEY (worker_id)
        REFERENCES user(id),
    FOREIGN KEY (task_id)
        REFERENCES tasks(id)
) ENGINE=InnoDB;
