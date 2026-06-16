-- HOUSES
CREATE TABLE b_lsr_houses
(
    ID         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    NAME       VARCHAR(255) NOT NULL,
    CREATED_AT TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- APARTMENTS
CREATE TABLE b_lsr_apartments
(
    ID         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    HOUSE_ID   INT UNSIGNED NOT NULL,
    NUMBER     VARCHAR(50) NOT NULL,
    STATUS     ENUM('free', 'reserved', 'sold') NOT NULL DEFAULT 'free',

    CREATED_AT TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (ID),

    KEY        IX_HOUSE_ID (HOUSE_ID),
    KEY        IX_STATUS (STATUS),

    CONSTRAINT FK_APARTMENTS_HOUSE
        FOREIGN KEY (HOUSE_ID)
            REFERENCES b_lsr_houses (ID)
            ON DELETE CASCADE
            ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- REQUESTS
CREATE TABLE b_lsr_requests
(
    ID           INT UNSIGNED NOT NULL AUTO_INCREMENT,
    NAME         VARCHAR(255) NOT NULL,
    EMAIL        VARCHAR(255) NOT NULL,
    PHONE        VARCHAR(50)  NOT NULL,
    APARTMENT_ID INT UNSIGNED NOT NULL,

    CREATED_AT   TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (ID),

    UNIQUE KEY UX_EMAIL (EMAIL),
    UNIQUE KEY UX_PHONE (PHONE),

    KEY          IX_APARTMENT_ID (APARTMENT_ID),

    CONSTRAINT FK_REQUEST_APARTMENT
        FOREIGN KEY (APARTMENT_ID)
            REFERENCES b_lsr_apartments (ID)
            ON DELETE RESTRICT
            ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- DATA
INSERT INTO b_lsr_houses (ID, NAME, CREATED_AT)
VALUES (1, 'Дом №1 — Центральный', NOW()),
       (2, 'Дом №2 — Северный', NOW()),
       (3, 'Дом №3 — Южный', NOW());

INSERT INTO b_lsr_apartments (ID, HOUSE_ID, NUMBER, STATUS, CREATED_AT)
VALUES (1, 1, '1A', 'free', NOW()),
       (2, 1, '1B', 'sold', NOW()),
       (3, 1, '2A', 'free', NOW()),

       (4, 2, '10', 'free', NOW()),
       (5, 2, '11', 'free', NOW()),
       (6, 2, '12', 'free', NOW()),

       (7, 3, '101', 'free', NOW()),
       (8, 3, '102', 'free', NOW()),
       (9, 3, '103', 'free', NOW());
