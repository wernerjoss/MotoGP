-- show_totals.sql

SELECT MGP_users.Name,MGP_users.Vorname,MGP_totals.Score from `MGP_users` inner Join `MGP_totals` on (MGP_users.UID = MGP_totals.UID) order by MGP_totals.Score DESC;
