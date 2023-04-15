-- 1. создание таблицы `posts`

CREATE TABLE IF NOT EXISTS `posts` (
   `id` INT PRIMARY KEY AUTO_INCREMENT,
   `theme` VARCHAR(255) NOT NULL,
   `text` VARCHAR(255) NOT NULL,
   `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   `user_id` INT NOT NULL,
CONSTRAINT fk_posts_user_id
       FOREIGN KEY (user_id)
           REFERENCES users (id)
           ON DELETE CASCADE
);

-- 2. Создание таблицы `users_roles`

CREATE TABLE IF NOT EXISTS `users_roles` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `roles` VARCHAR(255) NOT NULL,
    `user_id` INT NOT NULL,
    CONSTRAINT fk_user_roles_user_id
     FOREIGN KEY (user_id)
         REFERENCES users (id)
         ON DELETE CASCADE
);

-- 3. Создание таблицы `categories`

CREATE TABLE IF NOT EXISTS `categories` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `category` VARCHAR(255) NOT NULL
);

-- 4. Создание ассоциативной таблицы для отношения таблиц `posts` и `categories`

CREATE TABLE IF NOT EXISTS `users_roles_mapping`(
    `category_id` INT NOT NULL,
    `post_id` INT NOT NULL,
CONSTRAINT `fk_users_roles_mapping_category_id`
    FOREIGN KEY (category_id)
    REFERENCES categories (id)
    ON DELETE CASCADE,
CONSTRAINT `fk_users_roles_mapping_post_id`
    FOREIGN KEY (post_id)
    REFERENCES `posts` (id)
    ON DELETE CASCADE
);

-- 5. Добавление столбца в существующую таблицу

ALTER TABLE `table_name`
ADD COLUMN `deleted` TINYINT(1) NOT NULL DEFAULT 0;
-- 6. Добавление индекса для запроса
CREATE INDEX index_posts_deleted_id ON `posts` (deleted, id);