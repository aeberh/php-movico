# What's a Backing Bean? #

A Backing Bean in Movico is a PHP class that extends the `BackingBean` abstract class. It contains properties that can map to view components. It contains action methods that map to user events on the view (f.e. clicking a button) and that execute business logic in the case such action is performed.

A Backing Bean always has a scope. There are three possible scopes: request, session and application. A Backing Bean uses a scope by extending `RequestBean`, `SessionBean` or `ApplicationBean`.

To get an understanding of how scopes work, please take a look at the following examples:
  * [HelloBean](MvcExample.md), an example of a `RequestBean`
  * [LoginBean](#LoginBean.md), an example of a `SessionBean`
  * [CounterBean](#CounterBean.md), an example of an `ApplicationBean`

# Examples #

## LoginBean ##

A request scoped bean cannot hold information across different requests. Unlike session scoped beans, that survive as long as the user session. A user session in PHP lasts until a timeout is reached or if the user closes his browser.

A typical use for a session scoped bean is a bean that holds user information at login. At user logon, the login credentials the user enters are validated. If this succeeds, a reference to the user object is stored inside a SessionBean. This way, each page the user visits can use information from the stored information in the SessionBean. When the user signs out, the user object is removed from the bean.

Let's see how this works in practice. We will make three views, a login page, a logged-in page and a profile page. The login page contains input fields for a username and password. We will skip the validation and assume that the user enters the right credentials. When logged in, the user arrived to the logged-in page. From here he can navigate to his profile page where he can see his information.

### Creating the views ###

View `login.xml` contains the input fields and a button to sign in. When signed in, the user is redirected to the `logged-in.xml` view.
```
<view>
    <form>
        <panelGrid columns="1">
            <inputText value="#{LoginBean.username}"/>
            <inputSecret value="#{LoginBean.password}"/>
            <commandButton action="#{LoginBean.login}" value="Login"/>
        </panelGrid>
    </form>
</view>
```

View `logged-in.xml` only contains a button that brings the user to his profile page.
```
<view>
    <form>
        <commandButton action="#{LoginBean.toProfile}" value="Go to my profile"/>
    </form>
</view>
```

The `profile.xml` view just shows the name of the user that was logged in:
```
<view>
    <outputText value="Welcome, #{LoginBean.username}"/>
</view>
```

### Creating the LoginBean ###

First of all, our LoginBean should extend SessionBean. Inside the bean, the username and password are defined together with their (public) getter and setter. The `login` action method just navigates to the logged-in page (the property bindings on the login view will make sure the properties are filled with the values the user entered) if username and password are the same (great security, I know). The `toProfile` action method will just take the user to the profile view.
```
class LoginBean extends SessionBean {

    private $username;
    private $password;

    // getters and setters...

    public function login() {
        if($username == $password) {
            return "logged-in";
        }
        $this->username = "";
        $this->password = "";
        return null;
    }

    public function toProfile() {
        return "profile";
    }

}
```

### Testing the flow ###

When the user enters his credentials and the login succeeds, the user will go to the logged-in page. When the user now navigates on to the profile page, the session bean will still have "remembered" the user's name because the bean is in session scope.

You can change the bean to a request scoped bean by extending from RequestBean instead of SessionBean. In this case, once the user has accessed the profile page, his information will be lost.

## CounterBean ##

Suppose you want to store data _across_ user sessions. Put in another way, you want to share a bean between all the users in your application. A session scoped bean will not suffice because it addresses each user separately.

So, if user A enters some input to the system, we want user B to see that information as well. There are actually two different ways of doing this:
  * Store your data into the database and retrieve it for all users.
  * Store your data inside an **ApplicationBean**.

Most of the time it is clear which kind of data you want to store into a database. If your application is about a movie collection, it is clear that you want to store your movie information into a database. But when to use an ApplicationBean then?

Suppose that, inside your movie application, users can select a genre of movie out of a dropdown list. The possible values inside this dropdown are the same for all users who want to insert movies into the system. You _could_ store these values into the database as well, but this way it is harder if you want to add a genre in the future. This would be a good candidate for using the ApplicationBean.

As an example we will create a bean that holds the value for a counter. Each time a user (any user) presses a button, the counter is incremented.

### Creating the view ###

`counter.xml` contains an `outputText` that will display the counter and a button that will increment the counter. No surprises here.
```
<view>
    <outputText value="#{CounterBean.count}"/>
    <form>
        <commandButton action="#{CounterBean.increment}" value="Increment"/>
    </form>
</view>
```

### Implementing the CounterBean ###

The CounterBean is equally simple. We just specify a `count` field with its getter and the `increment` action method that... well, increments it. The only speciality is that your bean should of course extend **ApplicationBean**.
```
class CounterBean extends ApplicationBean {
	
    private $count = 0;
	
    public function increment() {
        $this->count++;
        return null;
    }
	
    public function getCount() {
        return $this->count;
    }
	
}
```

That's it! With only so few code you can share information across user sessions. Isn't that great?