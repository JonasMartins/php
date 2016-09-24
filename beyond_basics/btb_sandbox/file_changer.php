<?php
// If safe mode is on (in php.ini) then this PHP script 
// will only be able to modify files that have the same
// owner as this script has.

echo fileowner('file_basics.php');
echo "<br />";

// if we have Posix installed
$owner_id = fileowner('file_basics.php');
$owner_array = posix_getpwuid($owner_id);
echo $owner_array['name'];

echo "<br />";

//chown('file_permissions.php', 'jonas');
// chown only works if PHP is superuser
// making webserver/PHP a superuser is a big security issue

// if we have Posix installed
$owner_id = fileowner('file_basics.php');
$owner_array = posix_getpwuid($owner_id);
echo $owner_array['name']; // ainda imprime root, chmod não muda nada

echo "<br />";

// apenas os caracteres de permissões do arquivo
echo substr(decoct(fileperms('file_basics.php')), 2);

echo substr(decoct(fileperms('file_basics.php')), 2);
chmod('file_basics.php', 0444);
echo substr(decoct(fileperms('file_basics.php')), 2);

echo "<br />";
echo is_readable('file_basics.php') ? 'yes' : 'no';
echo "<br />";
echo is_writable('file_basics.php') ? 'yes' : 'no';
echo "<br />";

?>