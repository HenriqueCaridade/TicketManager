PRAGMA foreign_keys = ON;
.mode columns
.headers on
.nullvalue NULL

--------

CREATE TABLE IF NOT EXISTS User (
    username STRING PRIMARY KEY NOT NULL,
    name STRING NOT NULL,
    email STRING UNIQUE NOT NULL,
    password STRING NOT NULL,
    salt STRING NOT NULL,
    userType STRING NOT NULL CHECK (userType IN('Client', 'Agent', 'Admin'))
);

--------

CREATE TABLE IF NOT EXISTS Department (
    name STRING PRIMARY KEY NOT NULL,
    abbrev STRING UNIQUE NOT NULL
);

--------

CREATE TABLE IF NOT EXISTS TicketModel (
    id INTEGER PRIMARY KEY NOT NULL,
    publisher STRING NOT NULL REFERENCES User(username),
    date DATETIME NOT NULL,
    subject STRING NOT NULL,
    text STRING NOT NULL,
    department STRING NOT NULL REFERENCES Department(name),
    priority STRING NOT NULL CHECK (priority IN ('Normal', 'High', 'Urgent')) DEFAULT 'Normal',
    status STRING NOT NULL CHECK (status IN ('Not Done', 'Done')) DEFAULT 'Not Done',
    agentUsername STRING REFERENCES User(username) DEFAULT NULL
);

CREATE VIEW IF NOT EXISTS Ticket AS SELECT * FROM TicketModel;

--------

CREATE TABLE IF NOT EXISTS TicketChange (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    ticketId INTEGER NOT NULL REFERENCES Ticket(id),
    date DATETIME NOT NULL,
    type STRING NOT NULL CHECK (type IN ('Department', 'Priority', 'Status', 'Assign')),
    oldVal STRING,
    newVal STRING
);

--------

CREATE TABLE IF NOT EXISTS TicketComment (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    ticketId INTEGER NOT NULL REFERENCES Ticket(id),
    user STRING REFERENCES User(username),
    date DATETIME NOT NULL,
    text STRING NOT NULL
);

--------

CREATE TABLE IF NOT EXISTS Hashtag (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    value STRING NOT NULL
);

--------

CREATE TABLE IF NOT EXISTS FAQ (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    question STRING NOT NULL,
    answer STRING NOT NULL
);

--------

CREATE TABLE IF NOT EXISTS AgentInDepartment (
    agentUsername STRING NOT NULL REFERENCES User(username),
    department STRING NOT NULL REFERENCES Department(name)
);

--------

CREATE TABLE IF NOT EXISTS HashtagOfTicket (
    hashtagId INTEGER NOT NULL REFERENCES Hashtag(id),
    ticketId INTEGER NOT NULL REFERENCES Ticket(id)
);

-------

CREATE TABLE IF NOT EXISTS Filters (
    username STRING PRIMARY KEY REFERENCES User(username) NOT NULL,
    filterNormal BOOLEAN NOT NULL DEFAULT TRUE,
    filterHigh BOOLEAN NOT NULL DEFAULT TRUE,
    filterUrgent BOOLEAN NOT NULL DEFAULT TRUE,
    filterUnassigned BOOLEAN NOT NULL DEFAULT TRUE,
    filterAssigned BOOLEAN NOT NULL DEFAULT TRUE,
    filterDone BOOLEAN NOT NULL DEFAULT TRUE,
    filterDateFrom DATETIME NOT NULL DEFAULT '2020-01-01 00:00:00',
    filterDateTo DATETIME NOT NULL DEFAULT '2030-01-01 00:00:00'
);

--------------
-- TRIGGERS --
--------------

CREATE TRIGGER IF NOT EXISTS TicketInsert
INSTEAD OF INSERT ON Ticket
BEGIN
    INSERT INTO TicketModel (id, publisher, date, subject, text, department) VALUES (NEW.id, NEW.publisher, NEW.date, NEW.subject, NEW.text, NEW.department);
END;

CREATE TRIGGER IF NOT EXISTS TicketDelete
INSTEAD OF DELETE ON Ticket
BEGIN
    DELETE FROM TicketModel WHERE id = OLD.id;
END;


CREATE TRIGGER IF NOT EXISTS TicketChangeDepartment
INSTEAD OF UPDATE ON Ticket
WHEN OLD.department <> NEW.department
BEGIN
    UPDATE TicketModel SET department = NEW.department WHERE id = OLD.id;
    INSERT INTO TicketChange (ticketId, date, type, oldVal, newVal) VALUES (OLD.id, NEW.date, 'Department', OLD.department, NEW.department);
END;

CREATE TRIGGER IF NOT EXISTS TicketChangePriority
INSTEAD OF UPDATE ON Ticket
WHEN OLD.priority <> NEW.priority
BEGIN
    UPDATE TicketModel SET priority = NEW.priority WHERE id = OLD.id;
    INSERT INTO TicketChange (ticketId, date, type, oldVal, newVal) VALUES (OLD.id, NEW.date, 'Priority', OLD.priority, NEW.priority);
END;

CREATE TRIGGER IF NOT EXISTS TicketChangeStatus
INSTEAD OF UPDATE ON Ticket
WHEN OLD.status <> NEW.status
BEGIN
    UPDATE TicketModel SET status = NEW.status WHERE id = OLD.id;
    INSERT INTO TicketChange (ticketId, date, type, oldVal, newVal) VALUES (OLD.id, NEW.date, 'Status', OLD.status, NEW.status);
END;

CREATE TRIGGER IF NOT EXISTS TicketChangeAgent
INSTEAD OF UPDATE ON Ticket
WHEN (OLD.agentUsername IS NULL AND NEW.agentUsername IS NOT NULL)
OR (OLD.agentUsername IS NOT NULL AND NEW.agentUsername IS NULL)
OR OLD.agentUsername <> NEW.agentUsername
BEGIN
    UPDATE TicketModel SET agentUsername = NEW.agentUsername WHERE id = OLD.id;
    INSERT INTO TicketChange (ticketId, date, type, oldVal, newVal) VALUES (OLD.id, NEW.date, 'Assign', OLD.agentUsername, NEW.agentUsername);
END;

------

CREATE TRIGGER IF NOT EXISTS UserFilters
AFTER INSERT ON User
BEGIN
    INSERT INTO Filters(username) VALUES (NEW.username);
END;

CREATE TRIGGER IF NOT EXISTS updateUsers
AFTER UPDATE ON User
BEGIN
    UPDATE Filters SET username = (NEW.username) WHERE username = (OLD.username);
    UPDATE Ticket SET agentUsername = (NEW.username) WHERE agentUsername = (OLD.username);
    UPDATE AgentInDepartment SET agentUsername = (NEW.username) WHERE agentUsername = (OLD.username);
 END;
-------

CREATE TRIGGER IF NOT EXISTS DeleteUser
BEFORE DELETE ON User
BEGIN
    DELETE FROM Filters WHERE username = OLD.username;
    DELETE FROM AgentInDepartment WHERE agentUsername = OLD.username;
    DELETE FROM Ticket WHERE agentUsername = OLD.username;
END;

-------

CREATE TRIGGER IF NOT EXISTS DeleteDepartment
BEFORE DELETE ON Department
BEGIN
    DELETE FROM TicketModel WHERE department = OLD.name;
    DELETE FROM AgentInDepartment WHERE department = OLD.name;
END;

-------

CREATE TRIGGER IF NOT EXISTS DeleteTicket
BEFORE DELETE ON TicketModel
BEGIN
    DELETE FROM TicketChange WHERE ticketId = OLD.id;
    DELETE FROM TicketComment WHERE ticketId = OLD.id;
    DELETE FROM HashtagOfTicket WHERE ticketId = OLD.id;
END;

