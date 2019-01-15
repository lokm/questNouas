<?php 
echo $_SERVER['SCRIPT_NAME']."<br>";
echo $_SERVER['SCRIPT_FILENAME']."<br>";
  // Le .htaccess DOIT contenir la chaîne :
  // SetEnv ENV_HTACCESS_READING true

  if (array_key_exists ('ENV_HTACCESS_READING', $_SERVER))
  {
    echo "Yes ! .htaccess is read and used !!\n";
  }
  else
  {
    echo "NOn : The .htaccess is not read : add 'AllowOverride All' in your Apache configuration\n";
  }

 ?>