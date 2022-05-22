-- 3.2 Query

-- 1st view
DROP VIEW IF EXISTS erga_ana_ereunhth;

CREATE VIEW erga_ana_ereunhth AS 
SELECT p.title FROM project p
INNER JOIN works_on_project w
ON w.project_id = p.project_id
INNER JOIN researcher r
ON r.researcher_id = w.researcher_id
WHERE r.first_name = "Tiffany" AND r.last_name = "Stone"
;

SELECT * FROM erga_ana_ereunhth;

-- 2nd view
DROP VIEW IF EXISTS program_funds;

CREATE VIEW program_funds AS
SELECT p.title, p.funds FROM project p
INNER JOIN program pr
ON pr.program_id = p.program_id
WHERE pr.name_pr = "program224";

select * from program_funds;
