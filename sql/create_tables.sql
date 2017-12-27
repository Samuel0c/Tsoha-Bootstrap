CREATE TABLE RegisteredUser(
  id SERIAL PRIMARY KEY,
  username varchar(25) NOT NULL,
  password varchar(50) NOT NULL
);

CREATE TABLE Priority(
  importance_value INTEGER PRIMARY KEY CHECK (importance_value > 0 AND importance_value < 6)
);

CREATE TABLE Topic(
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL
);

CREATE TABLE Task(
  id SERIAL PRIMARY KEY,
  task_name varchar(60) NOT NULL,
  status boolean NOT NULL DEFAULT FALSE,
  notes varchar(300),
  owner_id INTEGER REFERENCES RegisteredUser(id),
  priority INTEGER REFERENCES Priority(importance_value)
);

CREATE TABLE Task_topic(
  task_id INTEGER REFERENCES Task(id),
  topic_id INTEGER REFERENCES Topic(id)
);

