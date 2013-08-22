<?php/**
================================================================================
dzialanie na localu
--------------------
dodajemy do windows/system32/driver/etc/hosts linijke:
127.0.0.1	startup

do pliku C:\wamp\bin\apache\Apache2.2.11\conf\extra\httpd-vhosts.conf
C:\wamp\bin\apache\Apache2.2.17\conf\extra

<VirtualHost *:80>

ServerName startup
DocumentRoot "c:\wamp\www\projekt-startup"
DirectoryIndex index.php

<Directory "c:\wamp\www\projekt-startup">

	AllowOverride All
	Allow from All

</Directory>
</VirtualHost>

<VirtualHost *:80>

ServerName localhost
DocumentRoot "c:\wamp\www"
DirectoryIndex index.php

<Directory "c:\wamp\www">

	AllowOverride All
	Allow from All

</Directory>
</VirtualHost>


httpd.conf
ustawiam includowanie pliku httpd-vhosts.conf
oraz wlaczam modul vhosts-cos tam;]

reset apache i jest ok
================================================================================
Kolory
-------
A50000 - czerwony (strzalka)
002A80 - niebieski (napisy)
212121 - szary napis w menu
F7F6F6 - szare tlo menu

================================================================================
Dodanie departamentu
---------------------
do pliku main.php dodaje w switch odpowiedniego includa
do tabeli `dep` dodaje wpis
do trackera ?
================================================================================
Informacje ogólne o projekcie
------------------------------
nazwa projektu -- w pliku config.php
nazwa adresu email -- w pliku config.php
dane bazy danych -- w pliku config.php

dekomenty zachowuja sie dokaldnie tak samo jak kazdy z departamentow,
aby dodac jakis dokument trzeba dodac wspis do tabeli catsub
dodac wpis do /module/doc/show_doc.php oraz dodac odpowiedni plik do
katalogu /module/inc/...

aby w trakerze dezaktywowac wyswietlanie kategorii w danym departamencie
trzeba dodac odpowiedni wpis w pliku show_tracker.php w instrukcji if

================================================================================

*/?>
