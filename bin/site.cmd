@echo off
set scriptPath = %~dp0..\manager\
set scriptName = site.php

rem Store the current directory path in the stack
pushd "%cd%"

cd /d %~dp0..\manager

IF "%1" == "find" goto list

IF NOT "%1" == "find" goto normal

goto end

:normal
php.exe "site.php" %*
goto end

:list
php.exe "site.php" list|find "%2"
goto end

:end

rem Resume the original directory path
popd