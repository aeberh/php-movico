# Introduction #

This component will render a datepicker with dropdown lists for day, month, year, hours and minutes.

# Attributes #

| **Name** | **Required** | **Default** | **Description** |
|:---------|:-------------|:------------|:----------------|
| **value** | yes          |             | Value expression corresponding to a Date object |
| **showTime** | no           | false       | If true, a time (hours & minutes) can be picked |
| **minutesInterval** | no           | 1           | Interval for which minute values will be displayed (e.g. if the interval is 15, the minutes picker will only display 00, 15, 30 and 45) |
| **yearStart** | no           | -3          | The number of years to go backward, prepended with a minus sign, or an actual year |
| **yearEnd** | no           | +3          | The number of years to go forward, prepended with a plus sign, or an actual year |

# Examples #

## Example 1: Basic functionality ##

Suppose we have a simple view with an `inputDate` and a submit button. If the form is submitted, the formatted date will be displayed on the page using a [outputDate](OutputDate.md) component. The view looks like this:

```
<view>
	<form>
		<inputDate value="#{InputDateBean.date}"/>
		<commandButton action="#{InputDateBean.submit}" value="Submit"/>
	</form>
	<outputDate value="#{InputDateBean.date}" format="%d-%m-%Y"/>
</view>
```

The bean is in this case just a container for the date value. The `submit()` function doesn't really do anything.

```
class InputDateBean extends RequestBean {

	private $date;

	public function submit() {
		return null;
	}

	public function getDate() {
		return $this->date;
	}

	public function setDate($date) {
		$this->date = $date;
	}

}
```

## Example 2: Year range ##

The dropdown list for selecting a year can be limited using the `yearStart` and `yearEnd` attributes. These attributes can hold a relative (e.g. `-5`) or an absolute (e.g. 2009) value.

The following example will list the years from 1900 until the current year minus 10 years.

```
<view>
	<form>
		<inputDate value="#{InputDateBean.date}" yearStart="1900" yearEnd="-10"/>
		<commandButton action="#{InputDateBean.submit}" value="Submit"/>
	</form>
	<outputDate value="#{InputDateBean.date}" format="%d-%m-%Y"/>
</view>
```

## Example 3: Time input ##

The following view will display time elements as well. The dropdown list for minutes will only display values 00 and 30 because of the `minutesInterval` attribute.

```
<view>
	<form>
		<inputDate value="#{InputDateBean.date}" showTime="true" minutesInterval="30"/>
		<commandButton action="#{InputDateBean.submit}" value="Submit"/>
	</form>
	<outputDate value="#{InputDateBean.date}" format="%d-%m-%Y %H:%M"/>
</view>
```