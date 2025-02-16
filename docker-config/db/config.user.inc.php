
<?php
$cfg['blowfish_secret'] = 'ki4qBgNeHQ'; /* YOU MUST FILL IN THIS FOR COOKIE AUTH! */

/* Servers configuration */
$i = 0;

/* First server */
$i++;
$cfg['Servers'][$i]['auth_type'] = 'cookie';
$cfg['Servers'][$i]['host'] = 'mysql';
$cfg['Servers'][$i]['user'] = 'root';
$cfg['Servers'][$i]['password'] = 'pass_@123';
$cfg['Servers'][$i]['extension'] = 'mysqli';
$cfg['Servers'][$i]['compress'] = false;
$cfg['Servers'][$i]['AllowNoPassword'] = false;

/* End of servers configuration */
