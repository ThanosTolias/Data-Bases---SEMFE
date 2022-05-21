-- Triggers

-- Triger: deliverable date in (start_date, end_date)
DROP TRIGGER IF EXISTS tr_deliverable_date;
DELIMITER //
CREATE TRIGGER tr_deliverable_date BEFORE INSERT ON deliverable
FOR EACH ROW
BEGIN
	DECLARE ddate DATE;
    DECLARE sdate DATE;
    DECLARE edate DATE;
    SET ddate = new.deliverable_date;
	SET sdate = 
    (SELECT p.start_date FROM project p
    WHERE p.project_id = new.project_id);
	SET edate = 
    (SELECT p.end_date FROM project p
	WHERE p.project_id = new.project_id);
    IF datediff(edate, ddate) <= 0 OR datediff(ddate, sdate) <= 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'deliverable date is not in the interval (start date of project, end date of project)';
	END IF;
END//
    
DELIMITER ;

-- Trigger: date_eval before the start date of the project
DROP TRIGGER IF EXISTS tr_start_date;
DELIMITER //
CREATE TRIGGER tr_start_date BEFORE INSERT ON project
FOR EACH ROW
BEGIN
	DECLARE evaldate DATE;
    DECLARE sdate DATE;
    SET sdate = new.start_date;
	SET evaldate = 
    (SELECT e.date_eval FROM evaluation e
    WHERE e.evaluation_id = new.evaluation_id);
    IF datediff(sdate, evaldate) <= 0 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'the project cannot start before its evaluation';
	END IF;
END//
    
DELIMITER ;

-- Trigger: if grade (evaluation) is less than 5 then the project cannot begin
DROP TRIGGER IF EXISTS tr_grade;
DELIMITER //
CREATE TRIGGER tr_grade BEFORE INSERT ON project
FOR EACH ROW
BEGIN
	DECLARE grade TINYINT;
	SET grade = 
    (SELECT e.grade FROM evaluation e
    WHERE e.evaluation_id = new.evaluation_id);
    IF grade < 5 THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'the project has too low grade to happen';
	END IF;
END//
    
DELIMITER ;

-- Trigger: evaluator of project cannot be one of the researchers of the project
DROP TRIGGER IF EXISTS tr_researcher;
DELIMITER //
CREATE TRIGGER tr_researcher BEFORE INSERT ON works_on_project
FOR EACH ROW
BEGIN
	DECLARE evaluator_id INT;
    SET evaluator_id = 
    (SELECT p.evaluator_id FROM project p
    WHERE p.project_id = new.project_id);
    IF evaluator_id = new.researcher_id THEN
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'evaluator of project cannot be a researcher in this project';
	END IF;
END//
    
DELIMITER ;