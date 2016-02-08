# No inline scripting #

Movico does not allow you to do CSS or JS scripting directly inside the view. The reason for this is to allow Movico views to remain clean, without bloated inline scripts. It is however extremely easy to import CSS and Javascript files to your views.

# Import CSS sylesheets #

To import a CSS stylesheet, use the `<css>` element. The `src` attribute denotes the location of the CSS file, relatively compared to the `/view/css` path of your Movico installation.

```
<view>
    <css src="forms.css"/>
    <css src="menu.css"/>
    ...
</view>
```

# Import Javascripts #

To import a Javascript, use the `<js>` element. The `src` attribute denotes the location of the script, relatively compared to the `/view/js` path of your Movico installation.

```
<view>
    <js src="jquery-1.4.1-min.js"/>
    ...
</view>
```