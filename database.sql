--
-- Script to create the database.
-- PostgreSQL
--
-- @author Ivan Wilhelm <ivan.whm@me.com>

-- Sequences

create sequence seq_user_user_id increment 1 minvalue 1 start 1 cache 1;
comment on sequence seq_user_user_id is 'Sequence to generate unique user identification';

create sequence seq_user_acc_user_access_id increment 1 minvalue 1 start 1 cache 1;
comment on sequence seq_user_acc_user_access_id is 'Sequence to generate unique user access identification';


CREATE TABLE user (
  user_id                     INT8 default nextval('seq_user_user_id'),
  name                        VARCHAR(100) not null,
  email                       VARCHAR(255),
  username                    VARCHAR(50) not null,
  password                    VARCHAR(255) not null,
  salt                        VARCHAR(255) not null,
  status                      CHAR(1) default 'A' not null,
  date_created                TIMESTAMP NOT NULL DEFAULT current_timestamp,
  date_updated                TIMESTAMP NOT NULL DEFAULT current_timestamp,
  CONSTRAINT pk_user_user_id PRIMARY KEY (user_id)
);
COMMENT ON TABLE user is 'Table to store the information about system users.';
COMMENT ON COLUMN user.user_id is 'User unique code';
COMMENT ON COLUMN user.name is 'User full name';
COMMENT ON COLUMN user.email is 'User email address';
COMMENT ON COLUMN user.username is 'Username of the user';
COMMENT ON COLUMN user.password is 'Password of the user';
COMMENT ON COLUMN user.salt is 'Password SALT of the user';
COMMENT ON COLUMN user.status is 'Status of the record';
COMMENT ON COLUMN user.date_created is 'Date of the user was created';
COMMENT ON COLUMN user.date_updated is 'Date of the last updated';

CREATE TABLE user_access (
  user_access_id              INT8 DEFAULT nextval('seq_user_acc_user_access_id'),
  user_id                     INT8 NOT NULL,
  date_connection             TIMESTAMP NOT NULL DEFAULT current_timestamp,
  ip                          VARCHAR(255),
  stage                       CHAR(1) DEFAULT 'L' NOT NULL,
  CONSTRAINT pk_user_acc_user_access_id PRIMARY KEY (user_access_id)
);
COMMENT ON TABLE user_access is 'Table to store the information about user`s connection';
COMMENT ON COLUMN user_access.user_access_id is 'User access unique code';
COMMENT ON COLUMN user_access.user_id is 'User unique code';
COMMENT ON COLUMN user_access.date_connection is 'Date of connection';
COMMENT ON COLUMN user_access.ip is 'IP of user';
COMMENT ON COLUMN user_access.stage is 'Stage of the connection';

-- Index
CREATE INDEX idx_user_acc_user_user_id ON user_access (user_id);

-- Foreign Key
ALTER TABLE user_access
  ADD CONSTRAINT fk_user_user_access_user_id
  FOREIGN KEY (user_access)
  REFERENCES user (user_id)
  on update CASCADE on delete restrict;

