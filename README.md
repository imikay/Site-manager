Site manager: A PHP script that can manage virtual host
configs for you.

We asume that all you virtual host config files are 
all named with this pattern: [port]-[serverName].conf, eg.80-example.com.conf.


Usage:
---------------
Put the site.cmd in you system(Windows) path, and run the command [site].

Commands:
---------------
site list: list all virtual hosts with port and server name.

site new serverName [port]: create a new virtual host.

site rm serverName: remove the virtual host(Not implemented).
