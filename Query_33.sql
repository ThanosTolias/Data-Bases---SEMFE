with given(project_id) as
(select project_id 
from scientific_field_project
where scfield_id = 40532
)
select title 
from project 
where project.project_id in
(select project_id from given);

with given(project_id) as
(select project_id 
from scientific_field_project
where scfield_id = 40532
),
resIDs(researcher_id) as
(select researcher_id 
from works_on_project 
where works_on_project.project_id in
(select project_id from given))
select first_name, last_name from researcher 
where researcher.researcher_id in 
(select researcher_id from resIDs);
