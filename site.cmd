@echo off

IF "%1" == "find" goto list

IF NOT "%1" == "find" goto normal

goto end

:normal
php.exe "E:\php-commands\site.php" %*
goto end

:list
php.exe "E:\php-commands\site.php" list|find "%2"
goto end

:end
