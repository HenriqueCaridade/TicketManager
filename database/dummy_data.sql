

INSERT INTO User VALUES ('henrique', 'Henrique Caridade', 'henrique.ps.caridade@gmail.com', '77575b26d3f272d7b18e39bde800ed1ed3f8d0f4471eb385828c01621952f362', 'a228cc6e331b3cc381516bad6cdf74ca', 'Admin');
INSERT INTO User VALUES ('igorcher', 'Igor Cherstnev'   , 'igorcherstnev@gmail.com'       , 'c1229ad71ac5f8f9e5aa62ad8b937fe42cf3352636f17c019533f1d992c73338', 'bb884e0d0887f5b3c935e74bf34af41a', 'Admin');
INSERT INTO User VALUES ('agent1'  , 'Agent One'        , 'agent.one@gmail.com'           , '2537c28d58b50070f343028b69bdfed36080e8a28d6894bf0189906b29a811a0', 'a7caf307c0ff09a209e4fb1a81a88a3a', 'Agent');
INSERT INTO User VALUES ('agent2'  , 'Agent Two'        , 'agent.two@gmail.com'           , '203b3904a52bd225874af0033ac04ff1cf5f1b4c358e8128e3ba8d4170080913', 'fe98f7cd2c028ebe78d120ae687f9c79', 'Agent');
INSERT INTO User VALUES ('agent3'  , 'Agent Three'      , 'agent.three@gmail.com'         , 'eadddf8da11395138250f95823fdbba8104e94453305b91b555992e88ba0c1bd', 'f57ecda92e8f3f9239db64bd264108e9', 'Agent');
INSERT INTO User VALUES ('dummy1'  , 'Dummy One'        , 'dummy.one@gmail.com'           , '25feaf18d04a25cc3adeebd4ecd40c24b077cd46e1db0ed221a104efae579042', 'aa0f639a2f2b21795a165b976a5fc835', 'Client');
INSERT INTO User VALUES ('dummy2'  , 'Dummy Two'        , 'dummy.two@gmail.com'           , 'a087fb73f88fc708e3d1b69dbbc46f46ce765bceed6fe25bf2bf07492ab362af', '04aef3d4b30dddaf465bce55b1f59061', 'Client');
INSERT INTO User VALUES ('dummy3'  , 'Dummy Three'      , 'dummy.three@gmail.com'         , '1e13aee26163247d2fbd950d754f81b16d78a8cc854ce2b43a36bee371d71e20', 'b00de92b2ec0b38f3a9098a62c25283e', 'Client');

INSERT INTO Department VALUES ('Technology', 'Tech');
INSERT INTO Department VALUES ('Ecommerce', 'Ecom');

INSERT INTO Ticket (id, publisher, department, publishDate, priority, subject, text) VALUES (1, 'dummy1', 'Technology', '2000-01-01 01:02:03', 'Normal', 'My ticket1.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci incidunt corporis veniam earum nobis officia dignissimos, ullam quasi nam id delectus cumque iusto dolor assumenda libero repellendus aliquid! Laudantium, ex.');
INSERT INTO Ticket (id, publisher, department, publishDate, priority, subject, text) VALUES (2, 'dummy1', 'Technology', '2000-01-02 04:05:06', 'High', 'My ticket2.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci incidunt corporis veniam earum nobis officia dignissimos, ullam quasi nam id delectus cumque iusto dolor assumenda libero repellendus aliquid! Laudantium, ex.');
INSERT INTO Ticket (id, publisher, department, publishDate, priority, subject, text) VALUES (3, 'dummy1', 'Technology', '2000-01-03 07:08:09', 'Urgent', 'My ticket3.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci incidunt corporis veniam earum nobis officia dignissimos, ullam quasi nam id delectus cumque iusto dolor assumenda libero repellendus aliquid! Laudantium, ex.');

INSERT INTO TicketStatus (ticketId, agentUsername, date, status) VALUES (1, NULL, '2000-01-01 01:02:03', 'Unassigned');
INSERT INTO TicketStatus (ticketId, agentUsername, date, status) VALUES (2, NULL, '2000-01-02 04:05:06', 'Unassigned');
INSERT INTO TicketStatus (ticketId, agentUsername, date, status) VALUES (3, NULL, '2000-01-03 07:08:09', 'Unassigned');

INSERT INTO FAQ (question, answer) VALUES ("I can't login what should I do?", "Contact one of the Admins!");
INSERT INTO FAQ (question, answer) VALUES ("I don't remember my password", "Contact one of the Admins!");

INSERT INTO AgentInDepartment(agentUsername, department) VALUES ('igorcher', 'Technology');
INSERT INTO AgentInDepartment(agentUsername, department) VALUES ('henrique', 'Technology');
