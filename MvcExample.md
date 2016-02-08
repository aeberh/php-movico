In this simple example we'll create a simple view containing an input field and a button. When a user enters his/her name into the field and presses the button, the page will display "Hello" followed by the name that was just entered.

![http://php-movico.googlecode.com/files/movico-1.png](http://php-movico.googlecode.com/files/movico-1.png)
![http://php-movico.googlecode.com/files/movico-2.png](http://php-movico.googlecode.com/files/movico-2.png)

# View #

A view in Movico is like a JSP page in JSF. In Movico, it is a strict XML file that is validated by a DTD. This is the view for our sample application (it is called `hello.xml` in the source code):

```
<?xml version="1.0"?>
<!DOCTYPE note SYSTEM "http://php-movico.googlecode.com/svn/trunk/php-movico/dtd/view.dtd">
<view>
    <outputText value="#{HelloBean.message}"/>
    <form>
        <inputText value="#{HelloBean.name}"/>
        <commandButton action="#{HelloBean.sayHello}" value="Say Hello!"/>
    </form>
</view>
```

Every view should have the `<view>` element as a root element. Inside it we created an `outputText` element with a `value` attribute that binds to the `message` property on the `HelloBean` managed bean. An `outputText` will render an HTML `<span>` element.

Next we defined a `<form>` element containing an `inputText` and a `commandButton`. The `inputText` binds to the bean's `name` field while the `commandButton`, that will render a submit button, will execute the `sayHello` action method on the bean.

This should all look very familiar to you if you've ever used JSF.

# Bean #

Like in JSF, Movico beans bind values of view elements (like the `inputText` and `commandButton` we just defined in our `hello.xml` view) to class properties.

We know from the view that our managed bean should hold a field `name` (with its getter and setter) that will bind to the input field, and a `message` field that is to be displayed in the `outputText` of the view.

The action method `sayHello` appends the entered name to the `"Hello"` string and assigns this value to `message`.

```
<?php
class HelloBean extends RequestBean {
	
    private $name;
    private $message;

    public function sayHello() {
        $this->message = "Hello, ".$this->name."!";
        return "hello";
    }
	
    public function getName() {
        return $this->name;
    }
	
    public function setName($name) {
        $this->name = $name;
    }
	
    public function getMessage() {
        return $this->message;
    }
	
}
?>
```

At last the method returns "`view`", which is the view (without the `.xml`) to navigate to after this method has been executed. In this case it is the same view we came from (`hello.xml`). Instead we could have returned `null`, because in that case the previous view is considered as the new view as well.

Note that our bean extends `RequestBean`. This means that the bean will be in request scope so it will be reinstantiated on subsequent requests. Read more about bean scopes [here](WritingBackingBeans#Bean_scopes.md).

# That's it! #

This is all you need for a working Movico application! Notice that:
  * By only programming for 2 minutes and adding 2 files you already have (admit it) an awesome application
  * You don't have to learn new components because they all resemble JSF components.
  * You're programming your beans in a nice OO way by only exposing properties you want to expose (through public accessors) and encapsulating non-public stuff.
  * But wait... You didn't do anything database related yet. No worries, check out the [ServiceBuilder](ServiceBuilder.md) page for that.

# Related topics #

  * [ComponentReference](ComponentReference.md): overview of the different components you can use in your views and how they are rendered
  * [WritingBackingBeans](WritingBackingBeans.md): more information about beans, including scope and managed properties
  * [ServiceBuilder](ServiceBuilder.md): learn how to persist data to a database in no time