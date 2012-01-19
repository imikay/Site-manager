Site manager: A PHP script that can manage virtual host
configs for you.

We asume that all you virtual host config files are 
all named with this pattern: [port]-[serverName].conf, eg.80-example.com.conf.


Usage:
---------------
Put the site.cmd in you system(Windows) path, and run the command [site].

Commands:
---------------
List all virtual hosts with port and server name:

    site list
    
Create a new virtual host:

    site new serverName [port] 

Remove a virtual host(Not implemented)

    site rm serverName 

Find a virtual host:

    site find serverName or port
    
Open a virtual host in browser:

    site open serverName or port
    
    