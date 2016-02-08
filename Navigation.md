# Introduction #

Request handling was implemented in Movico with the following requirements in thought:
  * **Bookmarkability** - It should be easy for users to bookmark a certain page in their browser, both in AJAX mode and synchronous mode.
  * **Readable URLs** - URLs should make sense. A URL like http://www.example.com/search.php?type=news&query=tokyo is not user friendly. Movico uses clean URLs like http://www.example.com/search/p/news/tokyo.
  * **Styling** - It should be easy to style navigation menus.

# GET vs. POST requests #

The HTTP protocol provides two methods that are important for web applications: GET and POST.
  * **GET** requests retrieve a new view, specified by the URL. In HTML, GET requests are primarily implemented as `<a>` tags. This complies to the `<renderLink>` component in Movico.
  * **POST** requests submit data to be processed by Movico's ActionController. In HTML, POST requests are implemented using `<form>` tags. Movico uses the `<form>` element as well.

# Navigation flow #

## GET requests ##

### Step 1: URL rewriting ###

GET requests in Movico are passed to the root `index.php` file of your Movico installation using `.htaccess` rewrite rules. The rewrite rules will convert the following pretty URL:
```
http://www.example.com/search/p/news/tokyo
```
to its counterpart:
```
http://www.example.com/?u=search/p/news/tokyo
```

### Step 2: Initializing URL parameters ###

URLs from GET requests usually contain URL parameters. The relative URL (the part after `?u=` in the previous step) consists of two parts, delimited by `/p/`:
  * **`search`** is the view name. It corresponds to a view file `view/search.xml` inside your Movico directory.
  * **`news/tokyo`** is a list of URL parameters, delimited by a forward slash `/`.

#### The `Context` class ####

In case of a GET request, the URL parameters will be initialized inside the `Context` class. The Context class provides static getters to retrieve the parameters' values from within e.g. a managed bean:

```
class Context {
	
	public static function hasParam($i) {
		// Checks if a parameter value is available on the specified index
	}
	
	public static function getParam($i, $default=null) {
		// Returns the value of the parameter on the specified index, 
		//or $default if it's not available
	}
	
}
```

### Step 3: View redirection ###

After the URL parameters are initialized, the user is redirected to the view (the first part of the relative URL). Usually, the view references one or more managed beans and their properties. Inside those managed beans, parameter values can be used to decide what the user will be seeing.

E.g. suppose the user navigates to http://www.example.com/message/p/Hello. The view `search.xml` looks something like this:

```
<view>
	<outputText value="#{MessageBean.message}"/>
</view>
```

The view references the managed bean `MessageBean`, with the following implementation:

```
class MessageBean extends RequestBean {

	public function getMessage() {
		return Context::getParam(0, "Default")."!";
	}

}
```

In this case, "Hello!" will be printed on the page. If the user would have requested http://www.example.com/message without the URL parameter, the printout would be "Default!", which is the fallback value for the first parameter.

## POST requests ##