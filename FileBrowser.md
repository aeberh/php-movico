# Introduction #

The `fileBrowser` component renders a [CKFinder](http://ckfinder.com/) instance, which is an Ajax enabled file browser that allows easy image and file management. The currently used version of CKFinder is **2.1**.

![http://docs.cksource.com/images/a/a9/CKFinder_interface.png](http://docs.cksource.com/images/a/a9/CKFinder_interface.png)

# Attributes #

This element has no attributes.


# Sample #

It is recommended to use the `fileBrowser` component in views that are only accessible by certain privileged roles. In such views, you can just use the component as follows:

```
<view>
	<fileBrowser rendered="#{LoginBean.admin}"/>
</view>
```