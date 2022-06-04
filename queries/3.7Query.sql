

with budget_pr(executive_id, organization_id, value)as
(select executive_id, organization_id, -1*sum(funds) from project group by executive_id, organization_id) ,
top5ing(executive_id, organization_id, value) as
(select executive_id, organization_id, -1*value from budget_pr group by value limit 5 )
select name_ex, name_org, value from executive, organization, top5ing where (executive.executive_id, organization.organization_id) = (top5ing.executive_id,top5ing.organization_id);
