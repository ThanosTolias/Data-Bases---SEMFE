-- 3.5 Query (mallon to swsto, gia dyo episthmonika pedia)

DROP VIEW IF EXISTS zeugh_pediwn;

CREATE VIEW zeugh_pediwn as
SELECT sc1.name_scfield name1, sc2.name_scfield name2, sc1.scfield_id + sc2.scfield_id as keyy
FROM scientific_field sc1
INNER JOIN scientific_field sc2
ON sc1.scfield_id < sc2.scfield_id;

DROP VIEW IF EXISTS erga_kleidi;

CREATE VIEW erga_kleidi as
SELECT project_id, sum(scfield_id) as keyy, count(*)
FROM scientific_field_project
GROUP BY project_id
HAVING COUNT(*) = 2;

SELECT concat(zp.name1, zp.name2) as namee, count(*) FROM zeugh_pediwn zp
INNER JOIN erga_kleidi ek
ON ek.keyy = zp.keyy
GROUP BY namee
ORDER BY count(*) desc;