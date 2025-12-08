-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema db_chocolat
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `db_chocolat` ;

-- -----------------------------------------------------
-- Schema db_chocolat
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_chocolat` DEFAULT CHARACTER SET utf8 ;
USE `db_chocolat` ;

-- -----------------------------------------------------
-- Table `db_chocolat`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_chocolat`.`users` ;

CREATE TABLE IF NOT EXISTS `db_chocolat`.`users` (
  `users_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_name` VARCHAR(45) NOT NULL,
  `user_mail` VARCHAR(120) NOT NULL,
  `user_pwd` VARCHAR(255) NOT NULL,
  `user_role` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`users_id`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `user_name_UNIQUE` ON `db_chocolat`.`users` (`user_name` ASC) ;

CREATE UNIQUE INDEX `user_mail_UNIQUE` ON `db_chocolat`.`users` (`user_mail` ASC) ;


-- -----------------------------------------------------
-- Table `db_chocolat`.`recipes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_chocolat`.`recipes` ;

CREATE TABLE IF NOT EXISTS `db_chocolat`.`recipes` (
  `recipes_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `recipe_title` VARCHAR(120) NOT NULL,
  `recipe_slug` VARCHAR(125) NOT NULL,
  `recipe_desc` TEXT NOT NULL,
  `recipe_img` VARCHAR(45) NULL,
  `recipe_cook_time` INT UNSIGNED NOT NULL,
  `recipe_created_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `users_users_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`recipes_id`),
  CONSTRAINT `fk_recipes_users`
    FOREIGN KEY (`users_users_id`)
    REFERENCES `db_chocolat`.`users` (`users_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `recipe_slug_UNIQUE` ON `db_chocolat`.`recipes` (`recipe_slug` ASC) ;

CREATE INDEX `fk_recipes_users_idx` ON `db_chocolat`.`recipes` (`users_users_id` ASC) ;


-- -----------------------------------------------------
-- Table `db_chocolat`.`ingredients`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_chocolat`.`ingredients` ;

CREATE TABLE IF NOT EXISTS `db_chocolat`.`ingredients` (
  `ingredients_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `ingredient_name` VARCHAR(100) NOT NULL,
  `ingredient_slug` VARCHAR(105) NOT NULL,
  PRIMARY KEY (`ingredients_id`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `ingredient_slug_UNIQUE` ON `db_chocolat`.`ingredients` (`ingredient_slug` ASC) ;


-- -----------------------------------------------------
-- Table `db_chocolat`.`comments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_chocolat`.`comments` ;

CREATE TABLE IF NOT EXISTS `db_chocolat`.`comments` (
  `comments_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `comment_message` VARCHAR(500) NOT NULL,
  `comment_created_date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `comment_is_published` TINYINT UNSIGNED NULL DEFAULT 0,
  `users_users_id` INT UNSIGNED NOT NULL,
  `recipes_recipes_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`comments_id`),
  CONSTRAINT `fk_comments_users1`
    FOREIGN KEY (`users_users_id`)
    REFERENCES `db_chocolat`.`users` (`users_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_recipes1`
    FOREIGN KEY (`recipes_recipes_id`)
    REFERENCES `db_chocolat`.`recipes` (`recipes_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_comments_users1_idx` ON `db_chocolat`.`comments` (`users_users_id` ASC) ;

CREATE INDEX `fk_comments_recipes1_idx` ON `db_chocolat`.`comments` (`recipes_recipes_id` ASC) ;


-- -----------------------------------------------------
-- Table `db_chocolat`.`likes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_chocolat`.`likes` ;

CREATE TABLE IF NOT EXISTS `db_chocolat`.`likes` (
  `likes_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `users_users_id` INT UNSIGNED NOT NULL,
  `recipes_recipes_id` INT UNSIGNED NOT NULL,
  `like_cote` TINYINT UNSIGNED NULL COMMENT '1 à 5',
  PRIMARY KEY (`likes_id`),
  CONSTRAINT `fk_likes_users1`
    FOREIGN KEY (`users_users_id`)
    REFERENCES `db_chocolat`.`users` (`users_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_likes_recipes1`
    FOREIGN KEY (`recipes_recipes_id`)
    REFERENCES `db_chocolat`.`recipes` (`recipes_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_likes_users1_idx` ON `db_chocolat`.`likes` (`users_users_id` ASC) ;

CREATE INDEX `fk_likes_recipes1_idx` ON `db_chocolat`.`likes` (`recipes_recipes_id` ASC) ;


-- -----------------------------------------------------
-- Table `db_chocolat`.`ingredients_has_recipes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_chocolat`.`ingredients_has_recipes` ;

CREATE TABLE IF NOT EXISTS `db_chocolat`.`ingredients_has_recipes` (
  `ingredients_ingredients_id` INT UNSIGNED NOT NULL,
  `recipes_recipes_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`ingredients_ingredients_id`, `recipes_recipes_id`),
  CONSTRAINT `fk_ingredients_has_recipes_ingredients1`
    FOREIGN KEY (`ingredients_ingredients_id`)
    REFERENCES `db_chocolat`.`ingredients` (`ingredients_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_ingredients_has_recipes_recipes1`
    FOREIGN KEY (`recipes_recipes_id`)
    REFERENCES `db_chocolat`.`recipes` (`recipes_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE INDEX `fk_ingredients_has_recipes_recipes1_idx` ON `db_chocolat`.`ingredients_has_recipes` (`recipes_recipes_id` ASC) ;

CREATE INDEX `fk_ingredients_has_recipes_ingredients1_idx` ON `db_chocolat`.`ingredients_has_recipes` (`ingredients_ingredients_id` ASC) ;


-- -----------------------------------------------------
-- Table `db_chocolat`.`category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_chocolat`.`category` ;

CREATE TABLE IF NOT EXISTS `db_chocolat`.`category` (
  `category_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_title` VARCHAR(100) NOT NULL,
  `category_slug` VARCHAR(105) NOT NULL,
  `category_desc` VARCHAR(600) NULL,
  PRIMARY KEY (`category_id`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `category_slug_UNIQUE` ON `db_chocolat`.`category` (`category_slug` ASC) ;


-- -----------------------------------------------------
-- Table `db_chocolat`.`category_has_recipes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_chocolat`.`category_has_recipes` ;

CREATE TABLE IF NOT EXISTS `db_chocolat`.`category_has_recipes` (
  `category_category_id` INT UNSIGNED NOT NULL,
  `recipes_recipes_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`category_category_id`, `recipes_recipes_id`),
  CONSTRAINT `fk_category_has_recipes_category1`
    FOREIGN KEY (`category_category_id`)
    REFERENCES `db_chocolat`.`category` (`category_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_category_has_recipes_recipes1`
    FOREIGN KEY (`recipes_recipes_id`)
    REFERENCES `db_chocolat`.`recipes` (`recipes_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE INDEX `fk_category_has_recipes_recipes1_idx` ON `db_chocolat`.`category_has_recipes` (`recipes_recipes_id` ASC) ;

CREATE INDEX `fk_category_has_recipes_category1_idx` ON `db_chocolat`.`category_has_recipes` (`category_category_id` ASC) ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
