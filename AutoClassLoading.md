# Traditional PHP applications #

In a traditional PHP application, if you want to use information from another PHP source file, you need to add `include` or `require` directives. If your application has hundreds of PHP files, the following problems arise:
  * Managing all inter-file relations becomes cumbersome and tiring.
  * Having dozens of includes or requires in each file clutters your code.
  * If you refactor (e.g. change a class name, move a class to another directory, ...), all dependencies must be verified again.

```
<?php
class Message {
    public function sayHello() {
        echo "Hello"
    }
}
?>
```

```
<?php
include("Message.php");
$m = new Message();
$m->sayHello();
?>
```

# Movico #

In Movico, this problem was solved by making sure that all your source files are inside the include path upfront. This means that each file inside your Movico installation is accessible automatically from whatever other file. You no longer need to worry about `include` and `require` directives and do some actual interesting coding instead.

```
<?php
$m = new Message();
$m->sayHello();
?>
```

# How is it done? #

Check `path.php` in the root of your Movico installation. This file will initialize the include path on each request, so you're sure to have access to all new files while developing.