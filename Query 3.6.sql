
with 
youngs(fname,lname,resea,age) as (select re.first_name,re.last_name,re.researcher_id, year(current_date())-year(re.birthdate) 
from researcher re where year(current_date())-year(re.birthdate)<40),
act1ve(proj) as (select pr.project_id from project pr where current_date()-end_date<0 and 
current_date()>start_date)
select youngs.fname,youngs.lname,count(*) from works_on_project wop 
inner join youngs on wop.researcher_id = youngs.resea 
inner join act1ve on wop.project_id = act1ve.proj group by wop.researcher_id order by count(*) desc;




