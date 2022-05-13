CREATE TABLE post
(
    id         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name       VARCHAR(255) NOT NULL,
    slug       VARCHAR(255) NOT NULL,
    content    TEXT(65000)  NOT NULL,
    created_at DATETIME     NOT NULL,
    image      VARCHAR(27),
    PRIMARY KEY (id)
);
CREATE TABLE category
(
    id      INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name    VARCHAR(255) NOT NULL,
    content TEXT(1000)   NOT NULL,
    slug    VARCHAR(255) NOT NULL,
    image   VARCHAR(27),
    PRIMARY KEY (id)
);
CREATE TABLE post_category
(
    post_id     INT UNSIGNED NOT NULL,
    category_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (post_id, category_id),
    CONSTRAINT fk_post
        FOREIGN KEY (post_id)
            REFERENCES post (id)
            ON DELETE CASCADE
            ON UPDATE RESTRICT,
    CONSTRAINT fk_category
        FOREIGN KEY (category_id)
            REFERENCES category (id)
            ON DELETE CASCADE
            ON UPDATE RESTRICT
);
CREATE TABLE image
(
    id   INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    created_at DATETIME     NOT NULL,
    PRIMARY KEY (id)
);
CREATE TABLE post_image
(
    post_id  INT UNSIGNED NOT NULL,
    image_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (post_id, image_id)
);

CREATE TABLE file
(
    id   INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    created_at DATETIME     NOT NULL,
    PRIMARY KEY (id)
);
CREATE TABLE post_file
(
    post_id     INT UNSIGNED NOT NULL,
    file_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (post_id, file_id)
);

CREATE TABLE user
(
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

/*,
    CONSTRAINT fk_post_image
        FOREIGN KEY (post_id)
            REFERENCES post (id)
            ON DELETE CASCADE
               ON UPDATE RESTRICT,
                      CONSTRAINT fk_image
                      FOREIGN KEY (image_id)
                      REFERENCES image (id)
                  ON DELETE CASCADE
                     ON UPDATE RESTRICT*/


/*,
    CONSTRAINT fk_post_file
        FOREIGN KEY (post_id)
            REFERENCES post (id)
            ON DELETE CASCADE
               ON UPDATE RESTRICT,
                      CONSTRAINT fk_file
                      FOREIGN KEY (file_id)
                      REFERENCES file (id)
                  ON DELETE CASCADE
                     ON UPDATE RESTRICT*/