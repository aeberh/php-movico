# Description #

The `selectOneMenu` component generates a normal dropdown field (`<select>` element) on your view. The possible options are backed by an associative array on your backing bean. When a user selects a value and submits the form, the key (and not the label) is transmitted to an associated field on the bean, which requires a public getter and setter.

# Attributes #
| **Name** | **Required** | **Contains** | **Default** | **Description** |
|:---------|:-------------|:-------------|:------------|:----------------|
| **value** | yes          | bean field binding | -           | Binds to a bean field containing the currently selected value of the dropdown element |
| **options** | yes          | bean field binding | -           | Binds to a bean field containing an associative array of key-label pairs |
| **action** | no           | bean action binding | -           | Binds to a bean action method that needs to be executing when changing the value of this dropdown element |

# Example 1: Normal use #
```
<selectOneMenu options="#{SomeBean.options}" value="#{SomeBean.selectedOption}"/>
```

```
<?php
class DropdownBean extends RequestBean {

	private $selectedOption;
	private $options = array(123=>"Java", 456=>"PHP", 789=>"ASP");

	public function getOptions() {
		return $this->options;
	}

	// getter and setter for $selectedOption

}
?>
```

# Example 2: Automatic submit #
Sometimes you want to enable users to submit a form just by selecting a value inside a dropdown field, without the need to click a submit button. You can easily include this behaviour by adding an `action` attribute to your component, containing the action method that needs to be executing when a new value is selected:

```
<selectOneMenu options="#{SomeBean.options}" value="#{SomeBean.selectedOption}" action="#{SomeBean.submit}"/>
```

```
<?php
class SomeBean extends RequestBean {

	private $selectedOption;
	private $options = array(123=>"Java", 456=>"PHP", 789=>"ASP");

	public function getOptions() {
		return $this->options;
	}

	public function submit() {
		// do something
		return null;
	}

	// getter and setter for $selectedOption

}
?>
```