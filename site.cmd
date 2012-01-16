@echo off

IF "%1" == "find" goto list
IF "%1" == "open" goto open

IF NOT "%1" == "find" goto normal

goto end

:normal
php.exe "E:\php-commands\site.php" %*
goto end

:list
php.exe "E:\php-commands\site.php" list|find "%2"
goto end

:open
explorer.exe "http://%2"
echo dasfadsf
goto end

:end
