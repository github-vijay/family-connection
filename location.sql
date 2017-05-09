CREATE TABLE location(
	user_id INT(11),
	latitude FLOAT(20,17),
	longitude FLOAT(20,17),
	FOREIGN KEY(user_id) REFERENCES user(id)
);