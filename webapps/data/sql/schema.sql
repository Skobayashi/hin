CREATE TABLE author (id INT AUTO_INCREMENT, name VARCHAR(20), created_at DATETIME, updated_at DATETIME, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE h_m (hin_id INT, model_id INT, PRIMARY KEY(hin_id, model_id)) ENGINE = INNODB;
CREATE TABLE hin (id INT AUTO_INCREMENT, author_id INT, dispatchday DATE, modelnumber VARCHAR(20), hourmeter VARCHAR(10), delivery DATE, user VARCHAR(20), outbreak DATE, attachment VARCHAR(30), message VARCHAR(10), contents VARCHAR(50), management VARCHAR(10), created_at DATETIME, updated_at DATETIME, INDEX author_id_idx (author_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE model (id INT AUTO_INCREMENT, name VARCHAR(15) NOT NULL, created_at DATETIME, updated_at DATETIME, PRIMARY KEY(id)) ENGINE = INNODB;
ALTER TABLE h_m ADD FOREIGN KEY (model_id) REFERENCES model(id);
ALTER TABLE h_m ADD FOREIGN KEY (hin_id) REFERENCES hin(id);
ALTER TABLE hin ADD FOREIGN KEY (author_id) REFERENCES author(id);
