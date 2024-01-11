-- --------------------------------------------------------
--
-- Table structure for table `daily_todo`
--
CREATE TABLE `daily_todo` (
  `id` INTEGER PRIMARY KEY AUTOINCREMENT,
  `day` varchar(15) NOT NULL,
  `story` text NOT NULL,
  `saved` tinyint(1) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `completed` tinyint(1) NOT NULL
  CONSTRAINT `fk_daily_todo_user_id`
  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)

);


-- --------------------------------------------------------
--
-- Table structure for table `user`
--
CREATE TABLE `user` (
  `id` INTEGER PRIMARY KEY AUTOINCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL
);


--
-- Constraints for table `daily_todo`
--
