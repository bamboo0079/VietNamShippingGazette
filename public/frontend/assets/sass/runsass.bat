@echo off 
cmd.exe /E:ON /K C:\Ruby22-x64\bin\sass --compass --watch --sourcemap _bootstrap.scss:../css/bootstrap.min.css --no-cache --style compressed
PAUSE