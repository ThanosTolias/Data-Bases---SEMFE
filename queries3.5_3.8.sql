-- Queries

-- Query 3.8
SELECT r.researcher_id, r.first_name, r.last_name, count(*) projects_without_deliverable
FROM researcher r
INNER JOIN works_on_project w
ON w.researcher_id = r.researcher_id
INNER JOIN 
(SELECT p.project_id
FROM project p
WHERE p.project_id NOT IN
(
	SELECT p.project_id
	FROM project p
	INNER JOIN deliverable d
	ON d.project_id = p.project_id
)
ORDER BY p.project_id
) nodel_projects
ON nodel_projects.project_id = w.project_id
GROUP BY r.first_name, r.last_name, r.researcher_id
HAVING count(*) >= 5;

-- Query 3.5 (but only with 2 scientific fields)

-- just a view for projects and scientific_field
DROP VIEW IF EXISTS epist;

CREATE VIEW epist AS
SELECT diepistimoniko.project_id, scfp.scfield_id, scf.name_scfield
FROM scientific_field_project scfp
INNER JOIN 
(SELECT scfp.project_id
FROM scientific_field_project scfp
GROUP BY scfp.project_id
HAVING COUNT(*) = 2
) diepistimoniko
ON diepistimoniko.project_id = scfp.project_id
INNER JOIN scientific_field scf
ON scf.scfield_id = scfp.scfield_id;

-- firstly, we take the above view and get rows like "project, Scfield1Scfield2" then we take rows like Scfield1Scfield2, count(*) order by count(*) desc
SET @row_number = 0;
SELECT scfieldd, count(*) FROM
(SELECT project_id, concat(name_scfield, scientific2) as scfieldd FROM
(
SELECT *, (@row_number := @row_number + 1) as row_num FROM 
(SELECT
	project_id,
	name_scfield,
	LEAD(name_scfield, 1) OVER (
		ORDER BY project_id
	) scientific2
FROM 
	epist
    ORDER BY project_id) epist2 
)epsit2
WHERE mod(epsit2.row_num, 2) = 1) epsist3
GROUP BY scfieldd
ORDER BY COUNT(*) DESC;
