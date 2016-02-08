# Introduction #

This component will render a WYSIWYG editor for creating structured web content. This component is based on the [elRTE](http://elrte.org/) open source editor.

![http://php-movico.googlecode.com/files/Screen%20shot%202012-02-26%20at%2019.01.57.png](http://php-movico.googlecode.com/files/Screen%20shot%202012-02-26%20at%2019.01.57.png)

# Attributes #

| **Name** | **Required** | **Default** | **Description** |
|:---------|:-------------|:------------|:----------------|
| **value** | yes          |             | Value expression corresponding to a string |
| **toolbar** | no           | normal      | Choose from a predefined toolbar (tiny, compact, normal, complete, maxi) |
| **height** | no           | 200         | Height of the rich text editor |
| **width** | no           | 300         | Width of the rich text editor |

# Examples #

## Example 1: Basic functionality ##

Simply place the rich text editor inside a form to use it similarly to other input components.

```
<view>
	<form>
		<inputRichText value="#{RichTextBean.value}"/>
		<commandButton action="#{RichTextBean.submit}" value="Save"/>
	</form>
	<outputDiv value="#{RichTextBean.value}"/>
</view>
```

The bean is in this case just a container for the HTML value. The `save()` function doesn't really do anything.

```
class RichTextBean extends RequestBean {

	private $value;

	public function save() {
		return null;
	}

	public function getValue() {
		return $this->value;
	}

	public function setValue($value) {
		$this->value = $value;
	}

}
```