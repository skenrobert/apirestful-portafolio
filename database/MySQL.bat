@echo off
title Eliminando base de datos MySQL
color 0a
pause
mysqladmin -uroot drop gps_app
pause
mysqladmin -uroot create gps_app