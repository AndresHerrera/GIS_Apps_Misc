BEGIN;
CREATE TABLE "thiessen" (gid serial PRIMARY KEY,
"id" int4,
"id_pluv" int2);
SELECT AddGeometryColumn('','thiessen','the_geom','-1','MULTIPOLYGON',2);
INSERT INTO "thiessen" ("id","id_pluv",the_geom) VALUES ('1','1','0106000000010000000103000000010000000500000000A01B3C0BA6304100C00B4C74212B4100E083B7DB99304100C00B4C74212B4100E083B7DB99304100C0B5E9F82A2B410060AAAD61A0304100C032FC862C2B4100A01B3C0BA6304100C00B4C74212B41');
INSERT INTO "thiessen" ("id","id_pluv",the_geom) VALUES ('2','2','0106000000010000000103000000010000000600000000603CC636A9304100C00B4C74212B4100A01B3C0BA6304100C00B4C74212B410060AAAD61A0304100C032FC862C2B4100605E6222A2304100C0094237342B4100603CC636A9304100400CA289212B4100603CC636A9304100C00B4C74212B41');
INSERT INTO "thiessen" ("id","id_pluv",the_geom) VALUES ('3','3','0106000000010000000103000000010000000500000000603CC636A930410040C1FF29372B4100603CC636A9304100400CA289212B4100605E6222A2304100C0094237342B410020ABCF0FA230410040C1FF29372B4100603CC636A930410040C1FF29372B41');
INSERT INTO "thiessen" ("id","id_pluv",the_geom) VALUES ('4','4','010600000001000000010300000001000000060000000060AAAD61A0304100C032FC862C2B4100E083B7DB99304100C0B5E9F82A2B4100E083B7DB9930410040C1FF29372B410020ABCF0FA230410040C1FF29372B4100605E6222A2304100C0094237342B410060AAAD61A0304100C032FC862C2B41');
END;