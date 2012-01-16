@echo off

IF "%1" == "find" goto list

IF NOT "%s" == "find" goto normal
goto end

:normal
php.exe "E:\php-commands\site.php" %*

:list
php.exe "E:\php-commands\site.php" list|find "%2"

:end
