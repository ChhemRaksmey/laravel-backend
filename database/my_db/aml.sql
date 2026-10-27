

DROP TABLE IF EXISTS aml_customer_type CASCADE;
CREATE TABLE aml_customer_type (recid CHARACTER VARYING(35) PRIMARY KEY, json_data JSON);
CREATE OR REPLACE VIEW vw_aml_customer_type AS
SELECT recid, COALESCE(json_data->>'c1', '') AS full_name
FROM aml_customer_type;
INSERT INTO aml_customer_type VALUES
	('I', '{"recid":"I", "c1":"INDIVIDUAL"}'),
	('E', '{"recid":"E", "c1":"ENTITY"}');


DROP TABLE IF EXISTS aml_risk_countries CASCADE;
CREATE TABLE aml_risk_countries (recid CHARACTER VARYING(35) PRIMARY KEY, json_data JSON);
CREATE OR REPLACE VIEW vw_aml_risk_countries AS
SELECT
    r.recid,
    elem.value AS risk_country
FROM aml_risk_countries r
LEFT JOIN LATERAL json_array_elements_text(
    CASE
        WHEN json_typeof(r.json_data->'c1') = 'array' THEN r.json_data->'c1'
        ELSE '[]'::json
    END
) WITH ORDINALITY AS elem(value, ordinality) ON TRUE;
INSERT INTO aml_risk_countries VALUES
	('I', '{"recid":"I","c1":["AF","AX","AL","DZ","AS"],"audit":{"current.number":"","record.status":"","override":"","inputter":"","datetime":"2026-10-26 12:29:55","authorisers":""}}');



DROP TABLE IF EXISTS aml_resources CASCADE;
CREATE TABLE aml_resources (recid CHARACTER VARYING(35) PRIMARY KEY, json_data JSON);
INSERT INTO aml_resources VALUES
	('Local',  '{"recid":"","c1":"Local Sanction List","c2":"Y","c3":"","audit":{"current.number":"","record.status":"","override":"","inputter":"","datetime":"2026-10-26 12:29:55","authorisers":""}}'),
	('NBC',    '{"recid":"","c1":"National Bank of Cambodia","c2":"Y","c3":"","audit":{"current.number":"","record.status":"","override":"","inputter":"","datetime":"2026-10-26 12:29:55","authorisers":""}}'),
	('UN',     '{"recid":"","c1":"United Nation","c2":"Y","c3":"https://scsanctions.un.org/resources/xml/en/consolidated.xml","audit":{"current.number":"","record.status":"","override":"","inputter":"","datetime":"2026-10-26 12:29:55","authorisers":""}}'),
	('EU',     '{"recid":"","c1":"Europeadid United","c2":"Y","c3":"https://webgate.ec.europa.eu/europeaid/fsd/fsf/public/files/xmlFullSanctionsList_1_1/content?token=n002pc6m","audit":{"current.number":"","record.status":"","override":"","inputter":"","datetime":"2026-10-26 12:29:55","authorisers":""}}'),
	('OFAC-C', '{"recid":"","c1":"OFAC Consolidated","c2":"Y","c3":"https://www.treasury.gov/ofac/downloads/consolidated/consolidated.xml","audit":{"current.number":"","record.status":"","override":"","inputter":"","datetime":"2026-10-26 12:29:55","authorisers":""}}'),
	('OFAC-S', '{"recid":"","c1":"OFAC SDN","c2":"Y","c3":"https://www.treasury.gov/ofac/downloads/sdn.xml","audit":{"current.number":"","record.status":"","override":"","inputter":"","datetime":"2026-10-26 12:29:55","authorisers":""}}');
CREATE OR REPLACE VIEW vw_aml_resources AS
SELECT
	recid,
	COALESCE(json_data->>'c1', '') AS full_name,
	COALESCE(json_data->>'c2', '') AS status,
	COALESCE(json_data->>'c3', '') AS end_point
FROM aml_resources;










