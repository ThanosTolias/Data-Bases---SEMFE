DROP DATABASE IF EXISTS dbproject;
CREATE DATABASE dbproject;
USE dbproject;

CREATE TABLE deliverable
(
	project_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    deliverable_id INT UNSIGNED NOT NULL,
    title VARCHAR(50) NOT NULL,
    abstract VARCHAR(50) NOT NULL,
	deliverable_date DATE NOT NULL,
    PRIMARY KEY (project_id, deliverable_id)
);

CREATE TABLE evaluation
(
	evaluation_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    grade TINYINT NOT NULL,
    date_eval DATE NOT NULL,
    PRIMARY KEY (evaluation_id)
);

CREATE TABLE program
(
	program_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name_pr VARCHAR(50) NOT NULL,
	management VARCHAR(50) NOT NULL,
    PRIMARY KEY (program_id)
);

CREATE TABLE executive
(
	executive_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name_ex VARCHAR(50) NOT NULL,
    PRIMARY KEY (executive_id)
);

CREATE TABLE organization
(
	organization_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name_org VARCHAR(50) NOT NULL,
    abbreviation VARCHAR(6) NOT NULL,
    city VARCHAR(50) NOT NULL,
    street VARCHAR(50) NOT NULL,
	postal_code INT NOT NULL,
    org_type ENUM('University', 'Company', 'Research Center') NOT NULL,
    funds_company INT DEFAULT NULL,
    budget_uni_ministry INT DEFAULT NULL, -- tsekaroume onomata attributes
    budget_rc1 INT DEFAULT NULL,
    budget_rc2 INT DEFAULT NULL,
    PRIMARY KEY (organization_id)
);

CREATE TABLE researcher
(
    researcher_id INT NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    birthdate DATE NOT NULL,
    gender ENUM('Male', 'Female', 'Non-Binary') NOT NULL,
	organization_id INT UNSIGNED NOT NULL,
    datework DATE NOT NULL,
    PRIMARY KEY (researcher_id),
	FOREIGN KEY (organization_id) REFERENCES organization(organization_id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE scientific_field
(
	scfield_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name_scfield VARCHAR(30) NOT NULL,
    PRIMARY KEY (scfield_id)
);

CREATE TABLE project
(
	project_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    title VARCHAR(50) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    abstract VARCHAR(200) NOT NULL,
    funds INT UNSIGNED NOT NULL,
    evaluator_id INT NOT NULL,
	accountable_id INT NOT NULL,
    program_id INT UNSIGNED NOT NULL,
	executive_id INT UNSIGNED NOT NULL,
    organization_id INT UNSIGNED NOT NULL,
	evaluation_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (project_id),
	FOREIGN KEY (evaluator_id) REFERENCES researcher(researcher_id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (accountable_id) REFERENCES researcher(researcher_id) ON DELETE RESTRICT ON UPDATE CASCADE,
	FOREIGN KEY (program_id) REFERENCES program(program_id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (executive_id) REFERENCES executive(executive_id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (organization_id) REFERENCES organization(organization_id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (evaluation_id) REFERENCES evaluation(evaluation_id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE works_on_project
(
	project_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
   	researcher_id INT NOT NULL,
	PRIMARY KEY (project_id, researcher_id),
    FOREIGN KEY (project_id) REFERENCES project(project_id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (researcher_id) REFERENCES researcher(researcher_id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE scientific_field_project
(
	scfield_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
   	project_id INT UNSIGNED NOT NULL,
	PRIMARY KEY (scfield_id, project_id),
    FOREIGN KEY (project_id) REFERENCES project(project_id) ON DELETE RESTRICT ON UPDATE CASCADE,
	FOREIGN KEY (scfield_id) REFERENCES scientific_field(scfield_id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE phone_number
(
	organization_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    phone BIGINT NOT NULL,
	PRIMARY KEY (organization_id, phone)
);