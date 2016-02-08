# Introduction #

Usually when you have deployed some interactive forms inside your application, you want to give your users some guidance when a certain action is completed successfully, or when something went wrong.

In Movico's service layer, error handling should be done using **exceptions**. Ultimately, exceptions that are thrown inside the service layer should be caught inside your beans, because otherwise your end-users would be stuck with nothing but an ugly stacktrace.

# Use messages in beans #

Movico provides a utility class, `MessageUtil`, which can be used from within your beans. `MessageUtil` has three static methods, conforming to the three **warning levels** you can disclose to your view:
  * `info` - Use this to inform users about something.
  * `success` - Use this to inform users that a certain action was completed successfully.
  * `error` - Use this to inform users that an error occurred during a certain action.

A typical example is presented below.

```
<?php
class LoginBean extends SessionBean {

	public function login() {
		if($this->isCredentialsCorrect()) {
			$this->addUserToSession();
			MessageUtil::success("You were logged in successfully!");
			return "home";
		} else {
			MessageUtil::error("Invalid credentials were supplied. Please try again.");
			return null;
		}
	}
	
	...

}
?>
```

# Show messages on views #

Once you've generated messages inside your beans, it's time to display them on your views. Meet `<message/>`, a tag with no inner content and no attributes. Just use the `<message/>` tag wherever you want to display the message that was generated inside your bean.

```
<view>
	<form>
		<message/>
		<inputText value="#{LoginBean.username}"/>
		<inputSecret value="#{LoginBean.password}"/>
		<commandButton action="#{LoginBean.login}" value="Login"/>
	</form>
</view>
```

The `<message/>` tag generates a `<div>` with classes `msg` and one of `info`, `error`, `success`. By default, it has a clearly separating styling.