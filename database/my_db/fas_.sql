


DROP TABLE IF EXISTS fas_account CASCADE;
CREATE TABLE fas_account (recid CHARACTER VARYING(35) PRIMARY KEY, json_data JSON);
CREATE OR REPLACE VIEW vw_fas_account AS SELECT COALESCE(json_data->>'c1', '') AS recid, COALESCE(json_data->>'c2', '') AS full_name, COALESCE(json_data->>'c3', '') AS narrative FROM fas_account;

DROP TABLE IF EXISTS fas_booking CASCADE;
CREATE TABLE fas_booking (recid CHARACTER VARYING(35) PRIMARY KEY, json_data JSON);
CREATE OR REPLACE VIEW vw_fas_booking AS SELECT COALESCE(json_data->>'c1', '') AS recid, COALESCE(json_data->>'c2', '') AS id_account, COALESCE(json_data->>'c3', '') AS id_model, COALESCE(json_data->>'c4', '') AS full_name, COALESCE(json_data->>'c5', '') AS asset_code, COALESCE(json_data->>'c6', '') AS legacy_no, COALESCE(json_data->>'c7', '') AS date_purchase, COALESCE(json_data->>'c8', '') AS lifetime, COALESCE(json_data->>'c9', '') AS date_expire, COALESCE(json_data->>'c10', '') AS cost FROM fas_booking;

DROP TABLE IF EXISTS fas_disposal CASCADE;
CREATE TABLE fas_disposal (recid CHARACTER VARYING(35) PRIMARY KEY, json_data JSON);
CREATE OR REPLACE VIEW vw_fas_disposal AS SELECT COALESCE(json_data->>'c1', '') AS recid, COALESCE(json_data->>'c2', '') AS date_effective, COALESCE(json_data->>'c3', '') AS narrative FROM fas_disposal;

DROP TABLE IF EXISTS fas_gdt_account CASCADE;
CREATE TABLE fas_gdt_account (recid CHARACTER VARYING(35) PRIMARY KEY, json_data JSON);
CREATE OR REPLACE VIEW vw_fas_gdt_account AS SELECT COALESCE(json_data->>'c1', '') AS recid, COALESCE(json_data->>'c2', '') AS effective_year, COALESCE(json_data->>'c3', '') AS method, COALESCE(json_data->>'c4', '') AS depreciation_rate, COALESCE(json_data->>'c5', '') AS narrative FROM fas_gdt_account;

DROP TABLE IF EXISTS fas_gdt_asset CASCADE;
CREATE TABLE fas_gdt_asset (recid CHARACTER VARYING(35) PRIMARY KEY, json_data JSON);
CREATE OR REPLACE VIEW vw_fas_gdt_asset AS SELECT COALESCE(json_data->>'c1', '') AS recid, COALESCE(json_data->>'c2', '') AS id_asset, COALESCE(json_data->>'c3', '') AS effective_year, COALESCE(json_data->>'c4', '') AS depreciation_rate FROM fas_gdt_asset;

DROP TABLE IF EXISTS fas_gdt_exchange CASCADE;
CREATE TABLE fas_gdt_exchange (recid CHARACTER VARYING(35) PRIMARY KEY, json_data JSON);
CREATE OR REPLACE VIEW vw_fas_gdt_exchange AS SELECT COALESCE(json_data->>'c1', '') AS recid, COALESCE(json_data->>'c2', '') AS effective_year, COALESCE(json_data->>'c3', '') AS exchange_rate, COALESCE(json_data->>'c4', '') AS narrative FROM fas_gdt_exchange;

DROP TABLE IF EXISTS fas_model CASCADE;
CREATE TABLE fas_model (recid CHARACTER VARYING(35) PRIMARY KEY, json_data JSON);
CREATE OR REPLACE VIEW vw_fas_model AS SELECT COALESCE(json_data->>'c1', '') AS recid, COALESCE(json_data->>'c2', '') AS id_account, COALESCE(json_data->>'c3', '') AS full_name, COALESCE(json_data->>'c4', '') AS narrative FROM fas_model;

DROP TABLE IF EXISTS fas_reverse CASCADE;
CREATE TABLE fas_reverse (recid CHARACTER VARYING(35) PRIMARY KEY, json_data JSON);
CREATE OR REPLACE VIEW vw_fas_reverse AS SELECT COALESCE(json_data->>'c1', '') AS recid, COALESCE(json_data->>'c2', '') AS date_effective, COALESCE(json_data->>'c3', '') AS narrative FROM fas_reverse;

DROP TABLE IF EXISTS fas_supplier CASCADE;
CREATE TABLE fas_supplier (recid CHARACTER VARYING(35) PRIMARY KEY, json_data JSON);
CREATE OR REPLACE VIEW vw_fas_supplier AS SELECT COALESCE(json_data->>'c1', '') AS recid, COALESCE(json_data->>'c2', '') AS full_name, COALESCE(json_data->>'c3', '') AS narrative FROM fas_supplier;

DROP TABLE IF EXISTS fas_transfer CASCADE;
CREATE TABLE fas_transfer (recid CHARACTER VARYING(35) PRIMARY KEY, json_data JSON);
CREATE OR REPLACE VIEW vw_fas_transfer AS SELECT COALESCE(json_data->>'c1', '') AS recid, COALESCE(json_data->>'c2', '') AS date_effective, COALESCE(json_data->>'c3', '') AS owner_name, COALESCE(json_data->>'c4', '') AS reciver_name, COALESCE(json_data->>'c5', '') AS narrative FROM fas_transfer;

DROP TABLE IF EXISTS fas_schedule CASCADE;
CREATE TABLE fas_schedule (recid CHARACTER VARYING(35) PRIMARY KEY, json_data JSON);

DROP TABLE IF EXISTS fas_gdt_schedule CASCADE;
CREATE TABLE fas_gdt_schedule (recid CHARACTER VARYING(35) PRIMARY KEY, json_data JSON);

DROP VIEW IF EXISTS vw_fas_schedule;
CREATE OR REPLACE VIEW vw_fas_schedule AS 
SELECT 
	s.recid AS id_asset,
    (elm.value->>'date')::DATE AS schedule_date,
    (elm.value->>'origin_cost')::numeric AS origin_cost,
    (elm.value->>'reminding')::numeric AS reminding,
    (elm.value->>'depreciated')::numeric AS depreciated,
    (elm.value->>'depreciation')::numeric AS depreciation,
    (elm.value->>'netbook')::numeric AS netbook,
    (elm.value->>'id_branch')::TEXT AS id_branch
FROM fas_schedule AS s,
    LATERAL json_each(s.json_data) AS elm
ORDER BY s.recid, elm.key DESC;

DROP VIEW IF EXISTS vw_fas_gdt_schedule;
CREATE OR REPLACE VIEW vw_fas_gdt_schedule AS 
SELECT 
	s.recid AS id_asset,
	(elm.value->>'date')::INT AS date,
	(elm.value->>'origin_cost')::NUMERIC(25, 2) AS origin_cost,
	(elm.value->>'method')::TEXT AS method,
	(elm.value->>'exchange_rate')::NUMERIC(25, 2) AS exchange_rate,
	(elm.value->>'origin_cost_khr')::NUMERIC(25, 2) AS origin_cost_khr,
	(elm.value->>'reminding')::NUMERIC(25, 2) AS reminding,
	(elm.value->>'depreciated')::NUMERIC(25, 2) AS depreciated,
	(elm.value->>'depreciation_rate')::NUMERIC(25, 2) AS depreciation_rate,
	(elm.value->>'depreciation')::NUMERIC(25, 2) AS depreciation,
	(elm.value->>'netbook')::NUMERIC(25, 2) AS netbook,
    (elm.value->>'id_branch')::TEXT AS id_branch
FROM fas_gdt_schedule AS s,
    LATERAL json_each(s.json_data) AS elm
ORDER BY s.recid, elm.key DESC;





INSERT INTO fas_account VALUES
	('COE', '{"recid":"COE", "c1":"Computer Equipment", "c2":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('COS', '{"recid":"COS", "c1":"Computer Software", "c2":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('EQP', '{"recid":"EQP", "c1":"Equipment", "c2":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('F&F', '{"recid":"F&F", "c1":"Furniture & Fixtures", "c2":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('LIM', '{"recid":"LIM", "c1":"Leasehold Improvement", "c2":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('MOV', '{"recid":"MOV", "c1":"Motor Vehicles", "c2":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}');

INSERT INTO fas_model VALUES
    ('MDL20262800001', '{"recid":"MDL20262800001", "c1":"COE", "c2":"6pro", "c3":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
    ('MDL20262800002', '{"recid":"MDL20262800002", "c1":"COE", "c2":"GE RJ45", "c3":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
    ('MDL20262800003', '{"recid":"MDL20262800003", "c1":"COS", "c2":"2.5 256GB", "c3":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
    ('MDL20262800004', '{"recid":"MDL20262800004", "c1":"COS", "c2":"2.5 2TB USB 3.0H3P", "c3":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
    ('MDL20262800005', '{"recid":"MDL20262800005", "c1":"EQP", "c2":"2.5 H3 1TB USB3", "c3":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
    ('MDL20262800006', '{"recid":"MDL20262800006", "c1":"EQP", "c2":"iMAC 24", "c3":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
    ('MDL20262800007', '{"recid":"MDL20262800007", "c1":"LIM", "c2":"9010", "c3":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
    ('MDL20262800008', '{"recid":"MDL20262800008", "c1":"LIM", "c2":"3050 MT Core i3", "c3":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
    ('MDL20262800009', '{"recid":"MDL20262800009", "c1":"MOV", "c2":"CTX MDS-9122T", "c3":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
    ('MDL20262800010', '{"recid":"MDL20262800010", "c1":"MOV", "c2":"EMC ML3 Tape Library", "c3":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
    ('MDL20262800011', '{"recid":"MDL20262800011", "c1":"MOV", "c2":"EMC PowerStore", "c3":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
    ('MDL20262800012', '{"recid":"MDL20262800012", "c1":"COE", "c2":"Monitor 27", "c3":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
    ('MDL20262800013', '{"recid":"MDL20262800013", "c1":"COE", "c2":"Optiplex", "c3":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}');

INSERT INTO fas_supplier VALUES
	('VDR-29993659999', '{"recid":"VDR-29993659999", "c1":"Migration", "c2":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
    ('VDR-20262800001', '{"recid":"VDR-20262800001", "c1":"OTHER", "c2":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('VDR-20262800002', '{"recid":"VDR-20262800002", "c1":"TC COMPUTER", "c2":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('VDR-20262800003', '{"recid":"VDR-20262800003", "c1":"SUVI Design&Construction Co., LTD", "c2":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('VDR-20262800004', '{"recid":"VDR-20262800004", "c1":"NTL Technology", "c2":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('VDR-20262800005', '{"recid":"VDR-20262800005", "c1":"IT Solution Services", "c2":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('VDR-20262800006', '{"recid":"VDR-20262800006", "c1":"Business Machine Solutions Co.,LTD", "c2":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('VDR-20262800007', '{"recid":"VDR-20262800007", "c1":"LAT SOPHAL OFFICE FUNITURE", "c2":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('VDR-20262800008', '{"recid":"VDR-20262800008", "c1":"PITTA ENGINEERING (Cambodia)Co.,LTD", "c2":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('VDR-20262800009', '{"recid":"VDR-20262800009", "c1":"NLH Electronic Shop", "c2":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('VDR-20262800010', '{"recid":"VDR-20262800010", "c1":"LEECO Safe & Funiture Co., LTD", "c2":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('VDR-20262800011', '{"recid":"VDR-20262800011", "c1":"PTC COMPUTER Co.,LTD", "c2":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('VDR-20262800012', '{"recid":"VDR-20262800012", "c1":"PKSM POWER SOLUTION SERVICE CO.,LTD", "c2":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('VDR-20262800013', '{"recid":"VDR-20262800013", "c1":"Vichet I", "c2":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('VDR-20262800014', '{"recid":"VDR-20262800014", "c1":"V-SOKRET CO.,LTD", "c2":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}');

INSERT INTO fas_booking VALUES
	('BK-2026280000001', '{"c1":"COE", "c2":"MDL20262800001", "c3":"Migrate Asset name 1", "c4":"101-COE-20262800001", "c5":"101-COE-20262800001", "c6":"2025-12-15", "c7":"3Y", "c8":"2028-12-14", "c9":"150.50", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('BK-2026280000002', '{"c1":"COS", "c2":"MDL20262800002", "c3":"Migrate Asset name 2", "c4":"101-COS-20262800002", "c5":"101-COS-20262800002", "c6":"2022-12-15", "c7":"6Y", "c8":"2028-12-14", "c9":"500.00", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('BK-2026280000003', '{"c1":"MOV", "c2":"MDL20262800003", "c3":"Migrate Asset name 3", "c4":"101-MOV-20262800003", "c5":"101-MOV-20262800003", "c6":"2024-12-15", "c7":"1Y", "c8":"2025-12-14", "c9":"250.00", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('BK-2026280000004', '{"c1":"COE", "c2":"MDL20262800004", "c3":"Migrate Asset name 4", "c4":"101-COE-20262800002", "c5":"101-COE-20262800002", "c6":"2024-10-04", "c7":"4Y", "c8":"2028-10-03", "c9":"390.00", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}');

INSERT INTO fas_transfer VALUES
	('BK-2026280000001', '{"c1":"2025-12-15", "c2":"", "c3":"Chhem Raksmey", "c4":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('BK-2026280000002', '{"c1":"2022-12-15", "c2":"", "c3":"Chhem Raksmey", "c4":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('BK-2026280000003', '{"c1":"2024-12-15", "c2":"", "c3":"Chhem Raksmey", "c4":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('BK-2026280000004', '{"c1":"2024-12-15", "c2":"", "c3":"Chhem Raksmey", "c4":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}');

INSERT INTO fas_disposal VALUES
	('BK-2026280000002', '{"c1":"2027-02-20", "c2":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}');

INSERT INTO fas_reverse  VALUES
	('BK-2026280000004', '{"c1":"2024-10-10", "c2":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}');

INSERT INTO fas_gdt_account VALUES
	('COE', '{"c1":"2000", "c2":"S", "c3":"0.25", "c4":"Miration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('COS', '{"c1":"2000", "c2":"D", "c3":"0.25", "c4":"Miration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('EQP', '{"c1":"2000", "c2":"S", "c3":"0.25", "c4":"Miration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('F&F', '{"c1":"2000", "c2":"D", "c3":"0.25", "c4":"Miration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('LIM', '{"c1":"2000", "c2":"D", "c3":"0.25", "c4":"Miration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('MOV', '{"c1":"2000", "c2":"S", "c3":"0.25", "c4":"Miration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}');

INSERT INTO fas_gdt_asset VALUES
	('BK-2026280000001',   '{"c1":"2025", "c2":"S", "c3":"0.25", "c4":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('BK-2026280000001;1', '{"c1":"2026", "c2":"D", "c3":"0.50", "c4":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('BK-2026280000001;2', '{"c1":"2027", "c2":"D", "c3":"0.15", "c4":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('BK-2026280000001;3', '{"c1":"2028", "c2":"S", "c3":"0.20", "c4":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('BK-2026280000002',   '{"c1":"2025", "c2":"S", "c3":"0.15", "c4":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('BK-2026280000003',   '{"c1":"2025", "c2":"S", "c3":"0.20", "c4":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('BK-2026280000004',   '{"c1":"2024", "c2":"S", "c3":"0.20", "c4":"Migration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}');

INSERT INTO fas_gdt_exchange VALUES
	('BK-2026280000001', '{"c1":"2025", "c2":"4000.00", "c3":"Miration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('BK-2026280000002', '{"c1":"2022", "c2":"4000.00", "c3":"Miration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('BK-2026280000003', '{"c1":"2023", "c2":"4000.00", "c3":"Miration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}'),
	('BK-2026280000004', '{"c1":"2024", "c2":"4000.00", "c3":"Miration", "audit":{"current.number":"1", "record.status":"NAU", "override":[], "inputter":"SYSTEM.MIGRATOR", "DATETIME":"20261201180347", "authoriser":[], "changes":[]}}');





DROP VIEW IF EXISTS vw_fas_account;
CREATE OR REPLACE VIEW vw_fas_account AS 
SELECT
	recid,
	COALESCE(json_data->>'c1', '') AS full_name,
	COALESCE(json_data->>'c2', '') AS narrative,
	COALESCE(json_data->'audit'->>'current.number', '') AS current_number,
	COALESCE(json_data->'audit'->>'record.status', '') AS record_status,
	COALESCE(json_data->'audit'->>'inputter', '') AS inputter,
	TO_CHAR(
    	TO_TIMESTAMP(COALESCE(json_data->'audit'->>'DATETIME', ''), 'YYYYMMDDHH24MISS'),
		'YYYY-MM-DD HH24:MI:SS'
	) AS datetime
FROM fas_account;


DROP VIEW IF EXISTS vw_fas_model;
CREATE OR REPLACE VIEW vw_fas_model AS 
SELECT
	recid,
	COALESCE(json_data->>'c1', '') AS id_account,
	COALESCE(json_data->>'c2', '') AS full_name,
	COALESCE(json_data->>'c3', '') AS narrative,
	COALESCE(json_data->'audit'->>'current.number', '') AS current_number,
	COALESCE(json_data->'audit'->>'record.status', '') AS record_status,
	COALESCE(json_data->'audit'->>'inputter', '') AS inputter,
	TO_CHAR(
    	TO_TIMESTAMP(COALESCE(json_data->'audit'->>'DATETIME', ''), 'YYYYMMDDHH24MISS'),
		'YYYY-MM-DD HH24:MI:SS'
	) AS datetime
FROM fas_model;


DROP VIEW IF EXISTS vw_fas_supplier;
CREATE OR REPLACE VIEW vw_fas_supplier AS 
SELECT
	recid,
	COALESCE(json_data->>'c1', '') AS id_account,
	COALESCE(json_data->>'c2', '') AS full_name,
	COALESCE(json_data->>'c3', '') AS narrative,
	COALESCE(json_data->'audit'->>'current.number', '') AS current_number,
	COALESCE(json_data->'audit'->>'record.status', '') AS record_status,
	COALESCE(json_data->'audit'->>'inputter', '') AS inputter,
	TO_CHAR(
    	TO_TIMESTAMP(COALESCE(json_data->'audit'->>'DATETIME', ''), 'YYYYMMDDHH24MISS'),
		'YYYY-MM-DD HH24:MI:SS'
	) AS datetime
FROM fas_supplier;


DROP VIEW IF EXISTS vw_fas_booking;
CREATE OR REPLACE VIEW vw_fas_booking AS 
SELECT
	recid,
	COALESCE(json_data->>'c1', '') AS id_account,
	COALESCE(json_data->>'c2', '') AS id_model,
	COALESCE(json_data->>'c3', '') AS full_name,
	COALESCE(json_data->>'c4', '') AS asset_code,
	COALESCE(json_data->>'c5', '') AS legacy_code,
	COALESCE(json_data->>'c6', '') AS date_purchase,
	COALESCE(json_data->>'c7', '') AS lifetime,
	COALESCE(json_data->>'c8', '') AS date_expire,
	COALESCE(json_data->>'c9', '') AS cost,
	COALESCE(json_data->'audit'->>'current.number', '') AS current_number,
	COALESCE(json_data->'audit'->>'record.status', '') AS record_status,
	COALESCE(json_data->'audit'->>'inputter', '') AS inputter,
	TO_CHAR(
    	TO_TIMESTAMP(COALESCE(json_data->'audit'->>'DATETIME', ''), 'YYYYMMDDHH24MISS'),
		'YYYY-MM-DD HH24:MI:SS'
	) AS datetime
FROM fas_booking;


DROP VIEW IF EXISTS vw_fas_transfer;
CREATE OR REPLACE VIEW vw_fas_transfer AS 
SELECT
	recid,
	COALESCE(json_data->>'c1', '') AS effective_date,
	COALESCE(json_data->>'c2', '') AS owner_name,
	COALESCE(json_data->>'c3', '') AS reciver_name,
	COALESCE(json_data->>'c4', '') AS narrative,
	COALESCE(json_data->'audit'->>'current.number', '') AS current_number,
	COALESCE(json_data->'audit'->>'record.status', '') AS record_status,
	COALESCE(json_data->'audit'->>'inputter', '') AS inputter,
	TO_CHAR(
    	TO_TIMESTAMP(COALESCE(json_data->'audit'->>'DATETIME', ''), 'YYYYMMDDHH24MISS'),
		'YYYY-MM-DD HH24:MI:SS'
	) AS datetime
FROM fas_transfer;


DROP VIEW IF EXISTS vw_fas_disposal;
CREATE OR REPLACE VIEW vw_fas_disposal AS 
SELECT
	recid,
	COALESCE(json_data->>'c1', '') AS effective_date,
	COALESCE(json_data->>'c2', '') AS narrative,
	COALESCE(json_data->'audit'->>'current.number', '') AS current_number,
	COALESCE(json_data->'audit'->>'record.status', '') AS record_status,
	COALESCE(json_data->'audit'->>'inputter', '') AS inputter,
	TO_CHAR(
    	TO_TIMESTAMP(COALESCE(json_data->'audit'->>'DATETIME', ''), 'YYYYMMDDHH24MISS'),
		'YYYY-MM-DD HH24:MI:SS'
	) AS datetime
FROM fas_disposal;


DROP VIEW IF EXISTS vw_fas_reverse;
CREATE OR REPLACE VIEW vw_fas_reverse AS 
SELECT
	recid,
	COALESCE(json_data->>'c1', '') AS effective_date,
	COALESCE(json_data->>'c2', '') AS narrative,
	COALESCE(json_data->'audit'->>'current.number', '') AS current_number,
	COALESCE(json_data->'audit'->>'record.status', '') AS record_status,
	COALESCE(json_data->'audit'->>'inputter', '') AS inputter,
	TO_CHAR(
    	TO_TIMESTAMP(COALESCE(json_data->'audit'->>'DATETIME', ''), 'YYYYMMDDHH24MISS'),
		'YYYY-MM-DD HH24:MI:SS'
	) AS datetime
FROM fas_reverse;


DROP VIEW IF EXISTS vw_fas_gdt_account;
CREATE OR REPLACE VIEW vw_fas_gdt_account AS 
SELECT
	recid,
	COALESCE(json_data->>'c1', '') AS effective_year,
	COALESCE(json_data->>'c2', '') AS depreciation_method,
	COALESCE(json_data->>'c3', '') AS depreciation_rate,
	COALESCE(json_data->>'c4', '') AS narrative,
	COALESCE(json_data->'audit'->>'current.number', '') AS current_number,
	COALESCE(json_data->'audit'->>'record.status', '') AS record_status,
	COALESCE(json_data->'audit'->>'inputter', '') AS inputter,
	TO_CHAR(
    	TO_TIMESTAMP(COALESCE(json_data->'audit'->>'DATETIME', ''), 'YYYYMMDDHH24MISS'),
		'YYYY-MM-DD HH24:MI:SS'
	) AS datetime
FROM fas_gdt_account;


DROP VIEW IF EXISTS vw_fas_gdt_asset;
CREATE OR REPLACE VIEW vw_fas_gdt_asset AS 
SELECT
	recid,
	COALESCE(json_data->>'c1', '') AS effective_year,
	COALESCE(json_data->>'c2', '') AS depreciation_method,
	COALESCE(json_data->>'c3', '') AS depreciation_rate,
	COALESCE(json_data->>'c4', '') AS narrative,
	COALESCE(json_data->'audit'->>'current.number', '') AS current_number,
	COALESCE(json_data->'audit'->>'record.status', '') AS record_status,
	COALESCE(json_data->'audit'->>'inputter', '') AS inputter,
	TO_CHAR(
    	TO_TIMESTAMP(COALESCE(json_data->'audit'->>'DATETIME', ''), 'YYYYMMDDHH24MISS'),
		'YYYY-MM-DD HH24:MI:SS'
	) AS datetime
FROM fas_gdt_asset;


DROP VIEW IF EXISTS vw_fas_gdt_exchange;
CREATE OR REPLACE VIEW vw_fas_gdt_exchange AS 
SELECT
	recid,
	COALESCE(json_data->>'c1', '') AS effective_year,
	COALESCE(json_data->>'c2', '') AS exchange_rate,
	COALESCE(json_data->>'c3', '') AS narrative,
	COALESCE(json_data->'audit'->>'current.number', '') AS current_number,
	COALESCE(json_data->'audit'->>'record.status', '') AS record_status,
	COALESCE(json_data->'audit'->>'inputter', '') AS inputter,
	TO_CHAR(
    	TO_TIMESTAMP(COALESCE(json_data->'audit'->>'DATETIME', ''), 'YYYYMMDDHH24MISS'),
		'YYYY-MM-DD HH24:MI:SS'
	) AS datetime
FROM fas_gdt_exchange;










DROP FUNCTION IF EXISTS fn_get_schedule (CHARACTER VARYING);
CREATE OR REPLACE FUNCTION fn_get_schedule (p_recid CHARACTER VARYING(25))
RETURNS TABLE (
	id_asset          TEXT,
    date_depreciation DATE,
	origin_cost       NUMERIC(25, 2),
	reminding         NUMERIC(25, 2),
	depreciated       NUMERIC(25, 2),
	depreciation      NUMERIC(25, 2),
	netbook           NUMERIC(25, 2)
)
LANGUAGE plpgsql
AS $$
#variable_conflict use_column
DECLARE
	v_rec              RECORD;
    v_id_asset         TEXT := '';
	v_no_days          INT := 1;
	v_date_start       DATE;
	v_date_expire      DATE;
	v_bal_reminding    NUMERIC(25, 2) := 0.00;
	v_bal_depreciated  NUMERIC(25, 2) := 0.00;
	v_bal_depreciation NUMERIC(25, 2) := 0.00;
	v_bal_netbook      NUMERIC(25, 2) := 0.00;
BEGIN

	v_id_asset := p_recid;

	IF v_id_asset = ''::TEXT THEN RETURN; END IF;

	FOR v_rec IN
		SELECT * FROM vw_fas_booking WHERE recid = v_id_asset
	LOOP

		v_date_start    := v_rec.date_purchase::DATE;
		v_date_expire   := v_rec.date_expire::DATE;
		v_no_days       := (v_date_expire - v_date_start)::INT + 1;
		v_bal_reminding := v_rec.cost::NUMERIC(25, 2);
		v_bal_netbook   := v_rec.cost::NUMERIC(25, 2);

		WHILE v_no_days > 0 LOOP

			v_bal_reminding    := v_bal_netbook::NUMERIC(25, 2);
			v_bal_depreciated  := (v_bal_depreciated + v_bal_depreciation)::NUMERIC(25, 2);
			v_bal_depreciation := ROUND((v_bal_netbook / v_no_days), 2)::NUMERIC(25, 2);
			v_bal_depreciation := LEAST(v_bal_depreciation, v_bal_netbook)::NUMERIC(25, 2);
			v_bal_netbook      := (v_bal_netbook - v_bal_depreciation)::NUMERIC(25, 2);

			id_asset          := v_rec.recid;
			date_depreciation := v_date_start;
			origin_cost       := v_rec.cost::NUMERIC(25, 2);
			reminding         := v_bal_reminding::NUMERIC(25, 2);
			depreciated       := v_bal_depreciated::NUMERIC(25, 2);
			depreciation      := v_bal_depreciation::NUMERIC(25, 2);
			netbook           := v_bal_netbook::NUMERIC(25, 2);
			RETURN NEXT;

			v_date_start := (v_date_start + INTERVAL '1 DAY')::DATE;
			v_no_days    := v_no_days - 1;
		END LOOP;
	
	END LOOP;

	RETURN;
END;
$$;


DROP FUNCTION IF EXISTS fn_get_gdt_schedule (CHARACTER VARYING);
CREATE OR REPLACE FUNCTION fn_get_gdt_schedule (p_recid CHARACTER VARYING(25))
RETURNS TABLE (
	id_asset          TEXT,
    date_depreciation INT,
	origin_cost       NUMERIC(25, 2),
	method            TEXT,
	exchange_rate     NUMERIC(25, 2),
	origin_cost_khr   NUMERIC(25, 2),
	reminding         NUMERIC(25, 2),
	depreciated       NUMERIC(25, 2),
	depreciation_rate NUMERIC(25, 2),
	depreciation      NUMERIC(25, 2),
	netbook           NUMERIC(25, 2)
)
LANGUAGE plpgsql
AS $$
#variable_conflict use_column
DECLARE
	v_rec               RECORD;
    v_id_asset          TEXT := '';
    v_method            TEXT := '';
	v_origin_cost       NUMERIC(25, 2);
	v_exchange_rate     NUMERIC(25, 2) := 0.00::NUMERIC(25, 2);
	v_depreciation_rate NUMERIC(25, 2) := 0.00::NUMERIC(25, 2);
	v_origin_cost_khr   NUMERIC(25, 2);
	v_date_start        INT;
	v_bal_reminding     NUMERIC(25, 2) := 0.00::NUMERIC(25, 2);
	v_bal_depreciated   NUMERIC(25, 2) := 0.00::NUMERIC(25, 2);
	v_bal_depreciation  NUMERIC(25, 2) := 0.00::NUMERIC(25, 2);
	v_bal_netbook       NUMERIC(25, 2) := 0.00::NUMERIC(25, 2);
BEGIN

	v_id_asset := p_recid;

	IF v_id_asset = ''::TEXT THEN RETURN; END IF;

	FOR v_rec IN
		SELECT * FROM vw_fas_booking WHERE recid = v_id_asset
	LOOP
	
		v_date_start      := TO_CHAR(v_rec.date_purchase::DATE, 'YYYY')::INT;
		v_origin_cost     := v_rec.cost::NUMERIC(25, 2);
		v_origin_cost_khr := v_rec.cost::NUMERIC(25, 2);
		v_bal_reminding   := v_rec.cost::NUMERIC(25, 2);
		v_bal_netbook     := v_rec.cost::NUMERIC(25, 2);

		v_method := COALESCE(
			(
				SELECT act2.depreciation_method
				FROM vw_fas_booking AS fa
					INNER JOIN vw_fas_account AS act1 ON fa.id_account = act1.recid
					INNER JOIN vw_fas_gdt_account AS act2 ON act1.recid = act2.recid
				WHERE fa.recid = v_rec.recid::TEXT
				ORDER BY act2.effective_year DESC LIMIT 1
			),
			''::TEXT
		)::TEXT;

		v_depreciation_rate := COALESCE(
			(
				SELECT depreciation_rate::NUMERIC(25, 2) FROM vw_fas_gdt_asset
				WHERE recid = v_rec.recid ORDER BY recid ASC LIMIT 1
			),
			0.00::NUMERIC(25, 2)
		)::NUMERIC(25, 2);

		v_exchange_rate := COALESCE(
			(
				SELECT exchange_rate::NUMERIC(25, 2) FROM vw_fas_gdt_exchange
				WHERE recid = v_rec.recid ORDER BY recid ASC LIMIT 1
			),
			0.00::NUMERIC(25, 2)
		)::NUMERIC(25, 2);

		IF v_method = ''::TEXT THEN EXIT; END IF;
		IF v_exchange_rate = 0.00::NUMERIC(25, 2) THEN EXIT; END IF;
		IF v_depreciation_rate = 0.00::NUMERIC(25, 2) THEN EXIT; END IF;
		

		WHILE v_bal_netbook > 0 LOOP

			v_method := COALESCE(
				(
					SELECT act2.depreciation_method
					FROM vw_fas_booking AS fa
						INNER JOIN vw_fas_account AS act1 ON fa.id_account = act1.recid
						INNER JOIN vw_fas_gdt_account AS act2 ON act1.recid = act2.recid
					WHERE fa.recid = v_rec.recid::TEXT AND act2.effective_year::INT <= v_date_start::INT
					ORDER BY act2.effective_year DESC LIMIT 1
				),
				v_method::TEXT
			)::TEXT;

			IF v_method = ''::TEXT THEN EXIT; END IF;

			v_depreciation_rate := COALESCE(
				(
					SELECT depreciation_rate::NUMERIC(25, 2) FROM vw_fas_gdt_asset
					WHERE recid = v_rec.recid
						AND effective_year::INT <= v_date_start::INT
					ORDER BY recid DESC LIMIT 1
				),
				v_depreciation_rate::NUMERIC(25, 2)
			)::NUMERIC(25, 2);

			v_exchange_rate := COALESCE(
				(
					SELECT exchange_rate::NUMERIC(25, 2) FROM vw_fas_gdt_exchange
					WHERE recid = v_rec.recid
						AND effective_year::INT <= v_date_start::INT
					ORDER BY recid DESC LIMIT 1
				),
				v_exchange_rate::NUMERIC(25, 2)
			)::NUMERIC(25, 2);

			v_origin_cost_khr := (v_rec.cost::NUMERIC(25, 2) * v_exchange_rate)::NUMERIC(25, 2);
			v_bal_depreciated := (v_bal_depreciated::NUMERIC(25, 2) + v_bal_depreciation::NUMERIC(25, 2))::NUMERIC(25, 2);
			v_bal_reminding   := (v_origin_cost_khr::NUMERIC(25, 2) - v_bal_depreciated::NUMERIC(25, 2))::NUMERIC(25, 2);

			IF v_method = 'S' THEN
				v_bal_depreciation := ROUND((v_origin_cost_khr * v_depreciation_rate), 0)::NUMERIC(25, 2);
			ELSE
				v_bal_depreciation := ROUND((v_bal_reminding * v_depreciation_rate), 0)::NUMERIC(25, 2);
			END IF;

			IF v_bal_depreciation::INT <=0 THEN EXIT; END IF;

			v_bal_depreciation := LEAST(v_bal_depreciation, v_bal_reminding)::NUMERIC(25, 2);
			v_bal_netbook      := (v_bal_reminding - v_bal_depreciation)::NUMERIC(25, 2);
			

			id_asset          := v_rec.recid;
			date_depreciation := v_date_start::INT;
			method            := v_method::TEXT;
			-- method            := CASE v_method::TEXT WHEN 'S' THEN 'Straight-Line Depreciation' WHEN 'D' THEN 'Declining Balance' ELSE '' END;
			depreciation_rate := v_depreciation_rate::NUMERIC(25, 2);
			origin_cost       := v_rec.cost::NUMERIC(25, 2);
			exchange_rate     := v_exchange_rate::NUMERIC(25, 2);
			origin_cost_khr   := v_origin_cost_khr::NUMERIC(25, 2);
			reminding         := v_bal_reminding::NUMERIC(25, 2);
			depreciated       := v_bal_depreciated::NUMERIC(25, 2);
			depreciation      := v_bal_depreciation::NUMERIC(25, 2);
			netbook           := v_bal_netbook::NUMERIC(25, 2);
			RETURN NEXT;

			v_date_start := v_date_start + 1;
			
		END LOOP;
	
	END LOOP;

	RETURN;
END;
$$;


DROP FUNCTION IF EXISTS fn_fas_rpt_asset_list;
CREATE OR REPLACE FUNCTION fn_fas_rpt_asset_list (
	p_account TEXT DEFAULT '',
	p_recid TEXT DEFAULT '',
	p_as_of_date DATE DEFAULT CURRENT_DATE
)
RETURNS TABLE (
	id_account TEXT,
	recid TEXT,
	asset_code TEXT,
	legacy_no TEXT,
	full_name TEXT,
	lifetime TEXT,
	date_purchase DATE,
	date_expire DATE,
	no_days INT,
	cost NUMERIC(25, 2),
	status TEXT,
	status_date DATE,
	owner_name TEXT 
)
LANGUAGE plpgsql
AS $$
BEGIN

	RETURN QUERY
	SELECT
		b.id_account::TEXT,
		b.recid::TEXT,
		b.asset_code::TEXT,
		b.legacy_no::TEXT,
		b.full_name::TEXT,
		b.lifetime::TEXT,
		b.date_purchase::DATE,
		b.date_expire::DATE,
		(b.date_expire::DATE - b.date_purchase::DATE)::INT AS no_days,
		b.cost::NUMERIC(25, 2),
		(CASE 
	        WHEN r.date_effective::DATE IS NOT NULL THEN 'Reversed'
	        WHEN d.date_effective::DATE IS NOT NULL THEN 'Disposaled'
	        WHEN b.date_expire::DATE <= CURRENT_DATE THEN 'Expired'
	        ELSE 'Active'
	    END)::TEXT AS status,
		(CASE 
	        WHEN r.date_effective::DATE IS NOT NULL THEN r.date_effective::DATE
	        WHEN d.date_effective::DATE IS NOT NULL THEN d.date_effective::DATE
	        WHEN b.date_expire::DATE <= CURRENT_DATE THEN b.date_expire::DATE
	        ELSE '1901-01-01'::DATE
	    END)::DATE AS status_date,
		t.reciver_name::TEXT AS owner_name
	FROM vw_fas_booking AS b
		INNER JOIN vw_fas_transfer AS t ON b.recid = t.recid
		LEFT JOIN vw_fas_disposal AS d ON b.recid = d.recid
		LEFT JOIN vw_fas_reverse AS r ON b.recid = r.recid
	WHERE b.date_purchase::DATE <= p_as_of_date::DATE
		AND ('' = p_account OR b.id_account = p_account)
		AND (
			p_recid::TEXT = b.recid::TEXT
			OR p_recid::TEXT = b.recid::TEXT
			OR p_recid::TEXT = b.asset_code::TEXT
			OR p_recid::TEXT = b.legacy_no::TEXT
			OR LOWER(b.full_name::TEXT) LIKE '%'|| LOWER(p_recid::TEXT) ||'%'
		)
	;

END;
$$;


DROP FUNCTION IF EXISTS fn_fas_rpt_asset_summary_by_account;
CREATE OR REPLACE FUNCTION fn_fas_rpt_asset_summary_by_account (
	p_account TEXT DEFAULT '',
	p_recid TEXT DEFAULT '',
	p_as_of_date DATE DEFAULT CURRENT_DATE
)
RETURNS TABLE (
	id_asset        TEXT,
	total_asset     INT,
	origin_cost     NUMERIC(25, 2),
	lm_reminding    NUMERIC(25, 2),
	lm_depreciated  NUMERIC(25, 2),
	lm_depreciation NUMERIC(25, 2),
	lm_netbook      NUMERIC(25, 2),
	tm_reminding    NUMERIC(25, 2),
	tm_depreciated  NUMERIC(25, 2),
	tm_depreciation NUMERIC(25, 2),
	tm_netbook      NUMERIC(25, 2)
)
LANGUAGE plpgsql
AS $$
DECLARE
    v_as_of_date            DATE;
	v_date_start_last_month DATE;
	v_date_end_last_month   DATE;
	v_date_start_this_month DATE;
	v_date_end_this_month   DATE;
BEGIN

	v_as_of_date            := p_as_of_date;
	v_date_start_this_month := DATE_TRUNC('month', v_as_of_date)::DATE;
	v_date_end_this_month   := v_as_of_date::DATE;
	v_date_end_last_month   := (v_date_start_this_month - INTERVAL '1 DAY')::DATE;
	v_date_start_last_month := DATE_TRUNC('month', v_date_end_last_month)::DATE;

	RETURN QUERY
	WITH
	tmp_fa AS (
		SELECT recid AS id_asset, id_account::TEXT, cost::NUMERIC(25, 2) AS cost
		FROM fn_fas_rpt_asset_list(
			p_account    := p_account::TEXT,
			p_recid      := p_recid::TEXT,
			p_as_of_date := v_date_end_this_month::DATE
		)
	),
    tmp_cost_summary AS (
        SELECT 
            id_account,
			count(id_account)::INT AS total_asset,
            SUM(cost)::NUMERIC(25, 2) AS total_origin_cost
        FROM tmp_fa
        GROUP BY id_account
    ),
	tmp_depreciation AS (
		SELECT
			fa.id_account::TEXT,
			
			MIN(CASE WHEN sc.schedule_date <= v_date_start_last_month                                THEN sc.reminding    ELSE sc.origin_cost END)::NUMERIC(25, 2) AS lm_reminding,
			MAX(CASE WHEN sc.schedule_date <= v_date_start_last_month                                THEN sc.depreciated  ELSE 0.00 END)::NUMERIC(25, 2)           AS lm_depreciated,
			SUM(CASE WHEN sc.schedule_date BETWEEN v_date_start_last_month AND v_date_end_last_month THEN sc.depreciation ELSE 0.00 END)::NUMERIC(25, 2)           AS lm_depreciation,
			MIN(CASE WHEN sc.schedule_date <= v_date_end_last_month                                  THEN sc.netbook      ELSE sc.origin_cost END)::NUMERIC(25, 2) AS lm_netbook,
			
			MIN(CASE WHEN sc.schedule_date <= v_date_start_this_month                                THEN sc.reminding    ELSE sc.origin_cost END)::NUMERIC(25, 2) AS tm_reminding,
			MAX(CASE WHEN sc.schedule_date <= v_date_start_this_month                                THEN sc.depreciated  ELSE 0.00 END)::NUMERIC(25, 2)           AS tm_depreciated,
			SUM(CASE WHEN sc.schedule_date BETWEEN v_date_start_this_month AND v_date_end_this_month THEN sc.depreciation ELSE 0.00 END)::NUMERIC(25, 2)           AS tm_depreciation,
			MIN(CASE WHEN sc.schedule_date <= v_date_end_this_month                                  THEN sc.netbook      ELSE sc.origin_cost END)::NUMERIC(25, 2) AS tm_netbook
		FROM tmp_fa AS fa
			INNER JOIN vw_fas_schedule AS sc ON fa.id_asset = sc.id_asset
		WHERE sc.schedule_date::DATE <= v_date_end_this_month::DATE
		GROUP BY fa.id_account
	)
	SELECT 
        c.id_account AS id_asset, c.total_asset,
        c.total_origin_cost AS origin_cost,
        d.lm_reminding, d.lm_depreciated, d.lm_depreciation, d.lm_netbook,
        d.tm_reminding, d.tm_depreciated, d.tm_depreciation, d.tm_netbook
    FROM tmp_cost_summary AS c
        INNER JOIN tmp_depreciation AS d ON c.id_account = d.id_account
	;

END;
$$;










DO $$
DECLARE
	v_rec RECORD;
BEGIN

    TRUNCATE fas_schedule;

	FOR v_rec IN
		SELECT DISTINCT recid FROM vw_fas_booking
	LOOP

		INSERT INTO fas_schedule
		SELECT
			v_rec.recid,
			REPLACE(
				'{' ||
				STRING_AGG(
					FORMAT(
						'%L:{"date": %L, "origin_cost":%L, "reminding":%L, "depreciated":%L, "depreciation":%L, "netbook":%L, "id_branch":%L}',
						date_depreciation, date_depreciation, origin_cost, reminding, depreciated, depreciation, netbook, ''
					),
					', ' ORDER BY date_depreciation
				)
				|| '}'
			,
			'''', '"')::JSON
			AS items
		FROM fn_get_schedule(v_rec.recid)
		GROUP BY v_rec.recid;
	
	END LOOP;

END;
$$;


DO $$
DECLARE
	v_rec RECORD;
BEGIN

    TRUNCATE fas_gdt_schedule;

	FOR v_rec IN
		SELECT DISTINCT recid FROM vw_fas_booking
	LOOP

		INSERT INTO fas_gdt_schedule
		SELECT
			id_asset,
			REPLACE(
				'{' ||
				STRING_AGG(
					FORMAT(
						'%L:{"date": %L, "origin_cost":%L, "method":%L, "exchange_rate":%L, "origin_cost_khr":%L, "reminding":%L, "depreciated":%L, "depreciation_rate":%L, "depreciation":%L, "netbook":%L, "id_branch":%L}',
						s.date_depreciation, s.date_depreciation, s.origin_cost, s.method, s.exchange_rate, origin_cost_khr, s.reminding, s.depreciated, s.depreciation_rate, s.depreciation, s.netbook, ''
					),
					', ' ORDER BY date_depreciation
				)
				|| '}'
			,
			'''', '"')::JSON
			AS items
		FROM fn_get_gdt_schedule(v_rec.recid) AS s
		GROUP BY s.id_asset;
	
	END LOOP;

END;
$$;











