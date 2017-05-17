ALTER TABLE user ADD column user_online_status TINYINT(1);
 ALTER TABLE user MODIFY COLUMN user_online_status TINYINT DEFAULT 0;
ALTER TABLE user ADD COLUMN last_seen INT(12);

CREATE TABLE `chat_record`(
 	`group_id` INT(11) DEFAULT 1,
 	`member_id` VARCHAR(20) NOT NULL,
 	`message` VARCHAR(255) NOT NULL,
 	`message_time` INT(12) NOT NULL,
 	FOREIGN KEY(member_id) REFERENCES user(user_no)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

