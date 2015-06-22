select 
case
when l.state_name ='' then concat(l.city_name,', ',l.country_name)
else concat(l.city_name,', ', l.state_name,', ', l.country_name)
end as lookup
 from location_city ct 
inner join location l on l.id_location=ct.id_location_city
order by ct.name

