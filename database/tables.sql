PRAGMA foreign_keys = ON;
.mode columns
.headers on
.nullvalue NULL

--------
DROP TABLE IF EXISTS User;

CREATE TABLE User (
    username STRING PRIMARY KEY NOT NULL,
    name STRING NOT NULL,
    email STRING UNIQUE NOT NULL,
    password STRING NOT NULL,
    salt STRING NOT NULL,
    userType STRING NOT NULL CHECK (userType IN('Client', 'Agent', 'Admin'))
);
--------

DROP TABLE IF EXISTS Department;

CREATE TABLE Department(
    name STRING PRIMARY KEY NOT NULL
);
--------

DROP TABLE IF EXISTS Ticket;

CREATE TABLE Ticket(
    id INTEGER PRIMARY KEY NOT NULL,
    publisher STRING NOT NULL REFERENCES User(username),
    department STRING NOT NULL REFERENCES Department(username),
    publishDate DATETIME NOT NULL,
    priority STRING NOT NULL CHECK (priority IN('Normal', 'High', 'Urgent')),
    subject STRING NOT NULL,
    text STRING NOT NULL
);

--------

DROP TABLE IF EXISTS TicketStatus;

CREATE TABLE TicketStatus(
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    ticketId INTEGER NOT NULL REFERENCES Ticket(id),
    agentUsername STRING REFERENCES User(username),
    date DATETIME NOT NULL,
    status STRING NOT NULL CHECK (status IN('Unassigned', 'In progress', 'Done'))
);

--------

DROP TABLE IF EXISTS TicketComment;

CREATE TABLE TicketComment(
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    ticketId INTEGER NOT NULL REFERENCES Ticket(id),
    user STRING REFERENCES User(username),
    date DATETIME NOT NULL,
    text STRING NOT NULL
);

--------

DROP TABLE IF EXISTS FAQ;

CREATE TABLE FAQ(
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    question STRING NOT NULL,
    answer STRING NOT NULL
);

--------

DROP TABLE IF EXISTS Hashtag;

CREATE TABLE Hashtag (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    ticketId INTEGER NOT NULL REFERENCES Ticket(id),
    hashtag STRING NOT NULL
);

--------

DROP TABLE IF EXISTS AgentInDepartment;

CREATE TABLE AgentInDepartment(
    agentUsername STRING NOT NULL REFERENCES User(username),
    department STRING NOT NULL REFERENCES Department(name)
);
