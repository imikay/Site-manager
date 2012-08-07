Site manager: A PHP script that can manage virtual host
configs for you.

We assume that all your virtual host config files are
named with this pattern: [port]-[serverName].conf, eg.80-example.com.conf.


Usage:
---------------
Put the site.cmd in you system(Windows) path, and run the command [site].

Commands:
---------------
List all the available commands:

    $ site

List all virtual hosts with port and server name:

    $ site list

Create a new virtual host:

    $ site new serverName [port]

Remove a virtual host(Not implemented)

    $ site rm serverName

Find a virtual host:

    $ site find serverName or port

Launch a site in browser:

    $ site launch serverName or port

Open config directory:

    $ site open-config-dir
