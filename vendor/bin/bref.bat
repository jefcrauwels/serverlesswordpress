@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../mnapoli/bref/bref
php "%BIN_TARGET%" %*
