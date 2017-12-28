INSERT INTO RegisteredUser (username, password) VALUES ('Thymine', 'trollol');

INSERT INTO RegisteredUser (username, password) VALUES ('Adenine', 'kukkaruukku');

INSERT INTO Priority (importance_value) VALUES ('3');

INSERT INTO Topic (name) VALUES ('Gardening');

INSERT INTO Task (task_name, status, notes, owner_id, priority) VALUES ('Plant the beans outside', 'false','Remember to place the beans next to the potatos and leave enough space between the plants.', '1', '3');

INSERT INTO Task_topic (task_id, topic_id) VALUES ('1', '1')
