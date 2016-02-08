# What is Movico? #

Movico is not just another MVC framework for PHP. It is inspired by [Java Server Faces](http://en.wikipedia.org/wiki/JavaServer_Faces) principles and other enterprise Java frameworks such as [Liferay Portal](http://www.liferay.com) and the [Spring](http://www.springsource.org) framework. It supports:
  * Automatic classloading
  * Writing request-scoped, session-scoped and application-scoped **backing beans**
  * Writing **XML views** with rich JSF-like components (inputRichText, dataTable, ...)
  * **Template** definitions based on JSF facelets, to reuse chunks of views that are to be included in multiple views
  * Auto-generation of service and domain layer from an entity definition file using the **Service Builder**
  * Full support for AJAX, including AJAX file uploads, bookmarkable URLs and working Back button.

## Convention over configuration ##

A lot of frameworks still need heavy configuration. In Movico the use of configuration files is very limited. Rather, developers need to know just a few (obvious) conventions and he or she is good to go. Read more about "Convention over configuration" in Movico [here](ConventionOverConfig.md).

## OO + XML all the way ##

If you don't like to code in an object oriented way this framework is probably _not_ for you. Unlike many other PHP frameworks, Movico is **100% object oriented** and the developer is ~~encouraged~~ _obliged_ to write valid OO code!

With that being said, the developer does not need any knowledge other than PHP and XML to start writing code in Movico. For AJAX support the developer does not have to write a single line of Javascript.

## Technical requirements ##

Movico supports **PHP 5.2** and higher. It currently only supports **MySQL** as a database, but this will change in the near future when the ORM layer will be implemented.

# What are you waiting for? #

  * Check out the 2-minute [example](MvcExample.md) for an instant view on the capabilities and ease-of-use that makes Movico your ideal MVC development companion.
  * Read in-depth documentation about the [Movico Framework](MovicoFramework.md).

# Where to download this piece of art? #

Download the nightly build [here](Downloads.md).