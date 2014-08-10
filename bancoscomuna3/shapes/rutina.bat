@echo off
set /p archivo=Ingrese Solo el Nombre del Archivo (sin .shp):
call "C:\Program Files\PostgreSQL\8.3\bin\shp2pgsql.exe" %archivo% %archivo% > %archivo%_sql.sql
pause
exit