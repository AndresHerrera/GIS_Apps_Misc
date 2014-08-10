BEGIN;
CREATE TABLE "pluviometros" (gid serial PRIMARY KEY,
"id" int4,
"id_pluv" varchar(50));
SELECT AddGeometryColumn('','pluviometros','the_geom','-1','POINT',2);
INSERT INTO "pluviometros" ("id","id_pluv",the_geom) VALUES ('1','1','010100000075E83377D79F3041DFE36958DE272B41');
INSERT INTO "pluviometros" ("id","id_pluv",the_geom) VALUES ('2','2','010100000019AC01BEB2A23041C6DC6B23B62D2B41');
INSERT INTO "pluviometros" ("id","id_pluv",the_geom) VALUES ('3','3','01010000000787D9001DA530410D9481805F312B41');
INSERT INTO "pluviometros" ("id","id_pluv",the_geom) VALUES ('4','4','0101000000037DA92E4F9F3041B939253FCD302B41');
END;
