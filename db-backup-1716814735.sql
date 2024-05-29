CREATE TABLE `admin` (
  `adminId` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`adminId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO admin VALUES("1", "admin", "admin123");



CREATE TABLE `candidates` (
  `candidate_id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  PRIMARY KEY (`candidate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO candidates VALUES("4", "Jabba", "0000-00-00", "09877564533");
INSERT INTO candidates VALUES("5", "balla", "0000-00-00", "09877564533");



CREATE TABLE `register` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO register VALUES("1", "pamitha", "p", "2024-05-09", "1234558788", "1");
INSERT INTO register VALUES("2", "suri", "s", "2024-05-17", "0410150811", "1");
INSERT INTO register VALUES("3", "saraswathi", "qwe12", "1996-06-11", "0410150809", "NULL");



CREATE TABLE `voter_results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `candidate_a` tinyint(4) NOT NULL,
  `candidate_b` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO voter_results VALUES("1", "pamitha", "1", "NULL");
INSERT INTO voter_results VALUES("2", "pamitha", "NULL", "1");
INSERT INTO voter_results VALUES("3", "suri", "1", "NULL");

