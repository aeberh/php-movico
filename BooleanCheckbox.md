# Attributes #

| **Name** | **Required** | **Default** | **Description** |
|:---------|:-------------|:------------|:----------------|
| value    | yes          |             | Value expression corresponding to the checked or unchecked state of the checkbox |
| action   | no           |             | If a value is provided for this attribute, the form containing the checkbox will automatically submit after the value of this checkbox has changed. On submission, the provided method expression will be executed. |
| label    | no           |             | If provided, the text inside this attribute will be rendered as a `<label>` element pointing to this booleanCheckbox element. |

# Examples #

## Normal usage ##

```
<view>
	<form>
		<inputText value="#{LoginBean.user}"/>
		<inputText value="#{LoginBean.pass}"/>
		<booleanCheckbox value="#{LoginBean.rememberMe}" label="Remember me"/>
		<commandButton="#{LoginBean.login}"/>
	</form>
</view>
```

```
<?php
class LoginBean extends SessionBean {
	
	// getters and setters ...

	private $rememberMe;

	public function login() {
		if($this->rememberMe) {
			$this->createCookie();
		}
		// ...
	}

}
?>
```

## Automatic submit ##

```
<view>
	<form>
		<booleanCheckbox value="#{SecretBean.secretVisible}" action="#{SecretBean.showOrHideSecret}"/>
		<outputText value="#{SecretBean.secret}"/>
	</form>
</view>
```

```
<?php
class SecretBean extends RequestBean {
	
	// getters and setters ...

	private $secretVisible;
	private $secret;

	public function showOrHideSecret() {
		if($this->secretVisible) {
			$this->secret = "THE SECRET!!!";
		}
		return null;
	}

}
?>
```