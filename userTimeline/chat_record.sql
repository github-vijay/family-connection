CREATE TABLE `chat_record`(
 	`group_id` INT(11) DEFAULT 1,
 	`member_id` VARCHAR(20) NOT NULL,
 	`message` VARCHAR(255) NOT NULL,
 	`message_time` INT(12) NOT NULL,
 	FOREIGN KEY(member_id) REFERENCES user(user_no)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;