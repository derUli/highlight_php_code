CREATE TABLE `{prefix}php_code` 
  ( 
     `id`   INT NOT NULL auto_increment, 
     `name` VARCHAR(140) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT 
     NULL, 
     `code` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL, 
     PRIMARY KEY (`id`), 
     UNIQUE (`name`) 
  ) 
engine = innodb; 