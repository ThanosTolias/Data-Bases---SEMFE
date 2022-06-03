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
AND (datediff(p.start_date, current_date()) <= 0 AND datediff(current_date(), p.end_date) <= 0)
ORDER BY p.project_id
) nodel_projects
ON nodel_projects.project_id = w.project_id
GROUP BY r.first_name, r.last_name, r.researcher_id
HAVING count(*) >= 5
ORDER BY count(*) desc;
