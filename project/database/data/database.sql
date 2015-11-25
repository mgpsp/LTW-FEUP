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

INSERT INTO Users VALUES (NULL, 'martalopes', '12345', 'marta@gmail.com', NULL);
INSERT INTO Users VALUES (NULL, 'miguelpereira', '12345', 'miguel@gmail.com', NULL);
INSERT INTO Users VALUES (NULL, 'franciscorodrigues', '12345', 'chico@gmail.com', NULL);

INSERT INTO Events VALUES (NULL, 'martalopes', "../images/eventBanner.png", "Event 1", "2015-12-25 09:30", "Event 1", "party");
INSERT INTO Events VALUES (NULL, 'franciscorodrigues', "../images/eventBanner.png", "Event 2", "2015-11-20 10:30", "Event 2", "party");

INSERT INTO Comments VALUES (NULL, "bla bla bla", 1, "martalopes");
INSERT INTO Comments VALUES (NULL, "ble ble ble", 1, "miguelpereira");
INSERT INTO Comments VALUES (NULL, "bli bli bli", 2, "franciscorodrigues");