php-notifier
============

A simple pure PHP API to add and use multiple notification services.

How to use?
------------

First you will need to install [Docker](https://www.docker.com/get-started) 
then run `make dev` to build and run the application.

Finally, you can make a request to the notify endpoint `http://local.notifier.app:8181/notify`
with a body like this:

````JSON
{
	"type": "email",
	"message": "<b>Hello world!</b>",
	"arguments": {
		"subject": "[INFO] Hello world!",
		"to": "user@email.com",
		"alias": "user"
	}
}
````

Testing
------------

To run the unit tests and the UI tests you can use the command `make test`.

Contributing
------------
You can make a fork of the repo and start helping out. Follow the [How to use?](#-How-to-use-?) instructions to start the application.
