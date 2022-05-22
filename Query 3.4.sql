
-- 3.4 


with table1(organization_id, year1, num1) as(
select pr.organization_id, year(pr.start_date) YYYY, count(*) from project pr group by pr.organization_id, 
year(pr.start_date) having count(*) >=2 order by pr.organization_id, year(pr.start_date)),
findtheorg(organization_id) as 
(select t1.organization_id from table1 t1 -- , t1.year1, t1.num1, t2.year1, t2.num1 
inner join table1 t2 on t1.organization_id = t2.organization_id and t1.year1 = t2.year1 + 1
where t1.num1 = t2.num1)
select name_org from organization 
where organization.organization_id in
(Select organization_id from findtheorg);

