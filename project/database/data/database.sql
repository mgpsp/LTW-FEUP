DROP TABLE IF EXISTS Users;
CREATE TABLE Users (
	userID INTEGER PRIMARY KEY AUTOINCREMENT,
	username TEXT NOT NULL UNIQUE,
	password TEXT NOT NULL,
	email TEXT NOT NULL UNIQUE,
	accountDate DATE DEFAULT (datetime('now','localtime'))
);

DROP TABLE IF EXISTS Events;
CREATE TABLE Events (
	eventID INTEGER PRIMARY KEY AUTOINCREMENT,
	host TEXT NOT NULL,
	banner TEXT,
	name TEXT NOT NULL,
	eventDate DATE NOT NULL,
	description TEXT,
	type TEXT NOT NULL
);

DROP TABLE IF EXISTS EventGuests;
CREATE TABLE EventGuests (
	eventID INTEGER REFERENCES Events(eventID) ON DELETE CASCADE,
	userID INTEGER REFERENCES Users(userID),
	status TEXT NOT NULL, --invited or going
	PRIMARY KEY(eventID, userID)
);

DROP TABLE IF EXISTS Comments;
CREATE TABLE Comments (
	commentID INTEGER PRIMARY KEY AUTOINCREMENT,
	content TEXT NOT NULL,
	eventID INTEGER REFERENCES Events(eventID),
	author TEXT NOT NULL
);

-- TESTING INFORMATION

INSERT INTO Users VALUES (NULL, 'John Doe', '12345', 'johndoe@gmail.com', NULL);
INSERT INTO Users VALUES (NULL, 'Jane Doe', '12345', 'janedoe@gmail.com', NULL);
INSERT INTO Users VALUES (NULL, 'Phil Doe', '12345', 'phildoe@gmail.com', NULL);

INSERT INTO Events VALUES (NULL, 'John Doe', "../images/eventBanner.png", "Event 1", "2015-12-25 09:30", "Event 1", "party");
INSERT INTO Events VALUES (NULL, 'Jane Doe', "../images/eventBanner.png", "Event 2", "2015-11-20 10:30", "Event 2", "party");

INSERT INTO Comments VALUES (NULL, "bla bla bla", 1, "John Doe");
INSERT INTO Comments VALUES (NULL, "ble ble ble", 1, "Jane Doe");
INSERT INTO Comments VALUES (NULL, "bli bli bli", 2, "Phil Doe");