CREATE TABLE `product_category` (
 `ID` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(255) DEFAULT NULL,
 `title` varchar(255) NOT NULL,
 `rank` int(11) DEFAULT NULL,
 PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

CREATE TABLE `product_spec` (
 `ID` int(11) NOT NULL AUTO_INCREMENT,
 `product_category_ID` int(11) NOT NULL,
 `spec` mediumtext NOT NULL,
 `rank` int(11) NOT NULL,
 `title` varchar(255) NOT NULL,
 `name` varchar(255) NOT NULL,
 PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8


CREATE TABLE `product_spec_item` (
 `ID` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(255) DEFAULT NULL,
 `title` varchar(255) NOT NULL,
 `level` int(11) NOT NULL,
 `rank` int(11) NOT NULL,
 `product_category_ID` int(11) NOT NULL,
 `parent_ID` int(11) DEFAULT NULL,
 PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8



