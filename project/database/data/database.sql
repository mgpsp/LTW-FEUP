PRAGMA foreign_keys = ON;

DROP TABLE IF EXISTS Users;
CREATE TABLE Users (
	userID INTEGER PRIMARY KEY AUTOINCREMENT,
	username TEXT NOT NULL UNIQUE,
	password TEXT NOT NULL,
	email TEXT NOT NULL UNIQUE,
	avatar TEXT,
	accountDate DATE DEFAULT (datetime('now','localtime'))
);

DROP TABLE IF EXISTS Events;
CREATE TABLE Events (
	eventID INTEGER PRIMARY KEY AUTOINCREMENT,
	host INTEGER NOT NULL REFERENCES Users(userID),
	banner TEXT,
	name TEXT NOT NULL,
	eventDate DATE NOT NULL,
	location TEXT NOT NULL,
	description TEXT,
	private BOOLEAN,
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
	eventID INTEGER REFERENCES Events(eventID) ON DELETE CASCADE,
	author INTEGER NOT NULL REFERENCES Users(userID),
	commentDate TEXT DEFAULT (datetime('now','localtime'))
);