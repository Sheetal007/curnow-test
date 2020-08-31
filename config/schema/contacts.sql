# Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
#
# Licensed under The MIT License
# For full copyright and license information, please see the LICENSE.txt
# Redistributions of files must retain the above copyright notice.
# MIT License (https://opensource.org/licenses/mit-license.php)

CREATE TABLE `curnow`.`contacts` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `first_name` VARCHAR(255) NOT NULL , `last_name` VARCHAR(255) NOT NULL , `company` VARCHAR(255) NOT NULL , `address` TEXT NOT NULL , `city` VARCHAR(255) NOT NULL , `county` VARCHAR(255) NOT NULL , `state_province` VARCHAR(255) NOT NULL , `zip` VARCHAR(255) NOT NULL , `phone_1` VARCHAR(255) NOT NULL , `phone_2` VARCHAR(255) NULL , `email` VARCHAR(255) NOT NULL , `web` VARCHAR(255) NULL , `created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , `modified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB; 