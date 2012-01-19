<?php
require_once __DIR__.'/config.php';

$fileNames = array_filter(array_filter(scandir($apacheConfigPath)), 
                          function ($v) use ($apacheConfigPath)
                          { 
                            return $v != '.' && $v != '..' && !is_dir($apacheConfigPath.$v);
                          }
                        );
                        
$ports = array_map(function ($fileName){ $fileName = explode('-', $fileName); return $fileName[0]; }, $fileNames);
$serverNames = array_map(function ($fileName){ $fileName = explode('-', rtrim($fileName, '.conf'), 2); return $fileName[1]; }, $fileNames);

                        
asort($ports);


if (count($argv) < 2)
{
  $doc = <<<DOC
  
Create a new site config for Apache.
    
    Usage: site [action] [name] [port] 
    
    Available actions:
      list                    -- list all sites
      new                     -- create new site
      rm                      -- remove a site
      open                    -- open a site by name or port
      find                    -- find one site by name or port

DOC;

  echo $doc;
  
  exit;
}

switch ($argv[1])
{
  case 'list':
    $str = "%s: %s\n";
    
    foreach ($ports as $index => $port)
    {    
      printf($str, $port, $serverNames[$index]);        
    }
  break;
  
  case 'new':
    $nextPort = end($ports) + 1;
    
    $name = strtolower(trim(isset($argv[2]) ? $argv[2] : ''));
    $port = isset($argv[3]) ? $argv[3] : $nextPort;
    
    if (!$name || in_array($name, $serverNames))
    {
      exit('You must provide a server name or the server name already exists');
    }
    
    if (in_array($port, $ports))
    {
      exit(sprintf("\nThe port is already in use, try another one please.(Maybe %s ?)\n", $nextPort));
    }
    
    if (!is_dir($siteDir))
    {
      mkdir($siteDir);
    }
    
    $docRoot = $siteDir.$name;
    
    if (is_dir($docRoot))
    {
      exit(sprintf("\n The [%s] directory already exists, try another please.\n", $docRoot));
    }
    
    mkdir($docRoot);
    
    $content = 'it works';
    
    $index = file_put_contents($docRoot.'/index.php', $content);
    
    $template = file_get_contents($template);
    $config = strtr($template, array('%PORT%' => $port, '%SERVER_NAME%' => $name, '%DOCUMENT_ROOT%' => $siteDir.$name));
    
    $configName = sprintf('%s%s-%s.conf', $apacheConfigPath, $port, $name);
    
    $ret = file_put_contents($configName, $config);
    
    // Add an entry to the hosts file
    $hostEntry = "\n127.0.0.1 ".$name."\n";
    $hosts = file_put_contents($hostFile, $hostEntry, FILE_APPEND);
        
    reset($ports);
    
    echo 'Done.';
  break;
  
  case 'rm':
    echo 'Not implemented';
  break;
  
  case 'open':
    $name = trim($argv[2]) ? strtolower(trim($argv[2])) : 'localhost';
    
    $port = 8080;
    
    $index1 = array_search($name, $serverNames);
    
    if ($index1 !== false)
    {
      $port = $ports[$index1];
      $host = $name;
    }
    else
    {
      $index2 = array_search($name, $ports);
      
      if ($index2 === false)
      {
        exit("\n Site not found \n");
      }
      
      $port = $name;
      $host = $serverNames[$index2];
    }
    
    system('explorer.exe http://'.$host.':'.$port);
  break;
  
  default:
    echo 'Please specify an action.';
  break;
}

