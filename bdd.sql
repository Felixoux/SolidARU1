/*Table post*/
CREATE TABLE post (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR (255) NOT NULL,
    slug VARCHAR (255) NOT NULL,
    content TEXT(65000) NOT NULL,
    created_at DATETIME NOT NULL,
    image VARCHAR (27),
    PRIMARY KEY (id)
);
/*Table category*/
CREATE TABLE category (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR (255) NOT NULL,
    content TEXT (1000) NOT NULL,
    slug VARCHAR (255) NOT NULL,
    image VARCHAR (27),
    PRIMARY KEY (id)
);
/* Bridge between post and category */
CREATE TABLE post_category (
    post_id INT UNSIGNED NOT NULL,
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
/*Table image*/
CREATE TABLE image (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR (255) NOT NULL,
  PRIMARY KEY (id)
);
/* Bridge between post and image */
CREATE TABLE post_image (
   post_id INT UNSIGNED NOT NULL,
   image_id INT UNSIGNED NOT NULL,
   PRIMARY KEY (post_id, image_id),
   CONSTRAINT fk_post_image
       FOREIGN KEY (post_id)
           REFERENCES post (id)
           ON DELETE CASCADE
           ON UPDATE RESTRICT,
   CONSTRAINT fk_image
       FOREIGN KEY (image_id)
           REFERENCES image (id)
           ON DELETE CASCADE
           ON UPDATE RESTRICT
);

/* Table user */
CREATE TABLE user (
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);