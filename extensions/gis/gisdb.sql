--
-- Create initial database for extensions/gis/database.php
-- Remember to replace /*$wgDBprefix*/ with your local value
--
-- # mysql -u USERNAME -p
-- use wikidb;
-- source gisdb.sql;
-- quit;
--

CREATE TABLE /*$wgDBprefix*/gis (
	gis_page int(8) unsigned NOT NULL,
	gis_latitude_min real NOT NULL,
	gis_latitude_max real NOT NULL,
	gis_longitude_min real NOT NULL,
	gis_longitude_max real NOT NULL,
	gis_globe char(12) binary NOT NULL default '',
	gis_type char(12) binary,
	gis_type_arg char(12) binary,

	KEY gis_id (gis_id),
	INDEX gis_globe (gis_globe)
);
