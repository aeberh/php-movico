# Enable AJAX support #

## Configuration ##

Enabling AJAX in Movico is extremely easy. Just set the following properties in `main.conf`:

```
ajax_enabled=true
ajax_timeout=7500
```

With the `ajax_enabled` parameter set to true, all form submits will be done asynchronously, enabling smooth and desktop-like view transitions. The default is `false`.

You can also specify how many milliseconds each AJAX request waits for its response using the `ajax_timeout` parameter. The default is `5000` (5 seconds). After the specified timeout, Movico will cease waiting and the user is allowed to do the same or another request.

## The `ajaxLoading` element ##

Because AJAX is asynchronous, it can sometimes take a while (depending on the server hardware, the network and the amount of work that needs to be done) before a response returns to the client. To give an indication to the user that the browser is waiting for a response, you can use the `ajaxLoading` element. This element will show a loading animation during each AJAX request. It has one parameter, `src`, that contains a _relative_ link to an image in the `view/img` folder.

If `src` is not specified, a default spinner image is used.

```
<view>
    <form>
        <inputText value="#{HelloBean.name}"/>
        <commandButton action="#{HelloBean.sayHello}" value="Say Hello!"/>
        <ajaxLoading src="loading.gif"/>
    </form>
</view>
```

If ajax is not enabled in the settings, this element will not render.


# Limitations #

  * Currently the `ajax_enabled` property is used in all views. So for the moment, you cannot use synchronous mode for some pages and asynchronous mode for others. This will be changed in the future by allowing to override the default setting by adding an attribute to the `view` component

# How does it work? #

## Technical aspects ##

For browser-compatible AJAX support the [jQuery](http://jquery.com/) library is used. The current version of Movico uses **jQuery v1.4.3**.

The nice thing about AJAX integration in Movico is that it only required an additional 30 lines of code to the existing, synchronous version! This proves that Movico is a very flexible and modular framework.

## Under the hood ##

When parsing the view, Movico checks if the AJAX parameter is enabled. If so, it adds a jQuery script to the view which will listen to the form submit event. In case of a form submission, it sends the serialized form data to the server.

If the server sees that AJAX is enabled, it will take the result of the controller (which is HTML) and send it back to the client, serialized.

The client will finally receive the data and replace its current view. The result is that the whole page seems to be refreshed. However, the end-user will always stay on the same page. This way the page transitions resemble screen transitions in traditional desktop applications.