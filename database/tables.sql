PRAGMA foreign_keys = ON;
.mode columns
.headers on
.nullvalue NULL

--------
DROP TABLE IF EXISTS User;

CREATE TABLE User (
    username STRING PRIMARY KEY NOT NULL,
    name STRING NOT NULL,
    password STRING NOT NULL,
    email STRING UNIQUE NOT NULL,
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
    ID INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    clientUsername STRING NOT NULL REFERENCES User(username),
    department STRING NOT NULL REFERENCES Department(username),
    publishDate DATETIME NOT NULL,
    priority STRING NOT NULL CHECK (priority IN('Normal', 'High', 'Urgent')),
    hashtag STRING NOT NULL
);
--------

DROP TABLE IF EXISTS TicketStatus;

CREATE TABLE TicketStatus(
    ID INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    ticketID INTEGER NOT NULL REFERENCES Ticket(ID),
    date DATETIME NOT NULL,
    status STRING NOT NULL CHECK (status IN('Unassigned', 'In progress', 'Done')),
    prevStatus INTEGER REFERENCES TicketStatus(ID)

);
--------
DROP TABLE IF EXISTS AgentInDepartment;

CREATE TABLE AgentInDepartment(
    agentUsername STRING NOT NULL REFERENCES User(username),
    department STRING NOT NULL REFERENCES Department(name)
);
