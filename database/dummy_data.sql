

INSERT INTO User VALUES ('henrique', 'Henrique Caridade', 'b2e98ad6f6eb8508dd6a14cfa704bad7f05f6fb1', 'henrique.ps.caridade@gmail.com', 'Admin');
INSERT INTO User VALUES ('igorcher', 'Igor Cherstnev'   , 'b2e98ad6f6eb8508dd6a14cfa704bad7f05f6fb1', 'igorcherstnev@gmail.com'       , 'Admin');
INSERT INTO User VALUES ('agent1'  , 'Agent One'        , 'b2e98ad6f6eb8508dd6a14cfa704bad7f05f6fb1', 'agent.one@gmail.com'           , 'Agent');
INSERT INTO User VALUES ('agent2'  , 'Agent Two'        , 'b2e98ad6f6eb8508dd6a14cfa704bad7f05f6fb1', 'agent.two@gmail.com'           , 'Agent');
INSERT INTO User VALUES ('agent3'  , 'Agent Three'      , 'b2e98ad6f6eb8508dd6a14cfa704bad7f05f6fb1', 'agent.three@gmail.com'         , 'Agent');
INSERT INTO User VALUES ('dummy1'  , 'Dummy One'        , 'b2e98ad6f6eb8508dd6a14cfa704bad7f05f6fb1', 'dummy.one@gmail.com'           , 'Client');
INSERT INTO User VALUES ('dummy2'  , 'Dummy Two'        , 'b2e98ad6f6eb8508dd6a14cfa704bad7f05f6fb1', 'dummy.two@gmail.com'           , 'Client');
INSERT INTO User VALUES ('dummy3'  , 'Dummy Three'      , 'b2e98ad6f6eb8508dd6a14cfa704bad7f05f6fb1', 'dummy.three@gmail.com'         , 'Client');

INSERT INTO Department VALUES ('Technology');

INSERT INTO Ticket (publisher, department, publishDate, priority, text) VALUES ('dummy1', 'Technology', '2000-01-01 01:02:03', 'Normal', 'My ticket1.');
INSERT INTO Ticket (publisher, department, publishDate, priority, text) VALUES ('dummy1', 'Technology', '2000-01-02 04:05:06', 'High', 'My ticket2.');
INSERT INTO Ticket (publisher, department, publishDate, priority, text) VALUES ('dummy1', 'Technology', '2000-01-03 07:08:09', 'Urgent', 'My ticket3.');

INSERT INTO TicketStatus (ticketId, agentUsername, date, status) VALUES (1, NULL, '2000-01-01 01:02:03', 'Unassigned');
INSERT INTO TicketStatus (ticketId, agentUsername, date, status) VALUES (2, NULL, '2000-01-02 04:05:06', 'Unassigned');
INSERT INTO TicketStatus (ticketId, agentUsername, date, status) VALUES (3, NULL, '2000-01-03 07:08:09', 'Unassigned');
