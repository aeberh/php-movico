# Introduction #

Use the `img` component to include images inside your views or templates.

# Attributes #

| **Name** | **Required** | **Default** | **Description** |
|:---------|:-------------|:------------|:----------------|
| **src**  | yes          |             | Value expression corresponding to the path to an image, relatively to the default image path `/www/img` |
| **alt**  | yes          |             | Value expression corresponding to the alternative text for this image to enhance [SEO](SEO.md) |
| **tooltip** | no           |             | Value expression corresponding to the tooltip text for this image |

# Example #

`img` components can be placed separately or inside a `commandLink` or `renderLink` tag.

```
<view>
	<img src="movico.png" alt="PHP-Movico" tooltip="Movico banner"/>
</view>
```

In this example, the `img` component will be converted to the following native IMG tag:

```
<img src="/www/img/movico.png" alt="PHP-Movico" title="Movico banner">
```