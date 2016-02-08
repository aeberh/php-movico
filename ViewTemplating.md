# Introduction #

Movico comes with a fully featured, custom written templating engine. The reason of not using an already existing templating solution, such as Smarty, lies in the fact that Movico views are written in XML, not PHP.

# From normal views to hierarchical templates #

Movico's templating system is based on principles of JSF Facelets. The next chapter will systematically explain how to leverage templates easily and in a reusable manner.

## Step 1: Normal views ##

Creating a **view** in Movico is pretty straight-forward. All you have to do is to create an XML-file in the `www/view` folder of your Movico installation. Suppose you create a file called `www/view/index.xml` with the following content:

```
<view>
	<h1>My Application</h1>
	<h2>General information</h2>
	<p>This is my profile</p>
</view>
```

You can access this view by going to http://www.myapp.com/index (supposed that Movico is installed in the root path).

Nothing fancy here. You've just created a single view that's independent of the other views in your installation. Of course, at this point, there is no way to reuse parts of this view inside other views. For that, we need a template.

## Step 2: Templates ##

### Templates ###

A **template** is very much like an ordinary view. The only real difference with a normal view, is that a template contains _insertion points_. The insertion points are placeholders for the dynamic parts of your page. They are represented by the `<insert>` element in your template and identified by a name.

For our previous example, we want to make the content inside the `<p>` tag dynamical. Therefore, we create a template with one insertion point, which will be the placeholder for the dynamic content inside the `<p>` tag.

Templates must be stored inside the `www/template` directory of your Movico installation. The different directory makes sure that templates cannot be referened directly by requesting a page! Suppose we create a `www/template/main.xml` with the following content:

```
<template>
	<h1>My Application</h1>
	<h2>General information</h2>
	<insert name="body"/>
</template>
```

It is clear that the template definition looks much like the view definition in the previous example. There are only 3 differences:
  * Templates use a `<template>` tag as root tag, while normal views use the `view` tag (duh)
  * Templates contain `<insert>` tags
  * Templates cannot be accessed directly by a URL. This wouldn't make sense anyway, so Movico just doesn't allow it

### Compositions ###

Now that our template is created, we can create multiple views based on that template. A view, based on a template, is called a **composition**. Compositions are very easy to create. They only must:
  * Specify on which template they are based
  * Provide values for all insertion points for that template

Compositions must be stored inside the `www/view` directory of your Movico installation. In the following example, we rewrite the view, created in [step 1](#Step_1:_Normal_views.md), to be a composition based on the template we just defined. For this, the `<define>` tag is used whoose name determines which insertion point we're providing a value for.

```
<composition template="main">
	<define name="body">
		<p>This is my profile</p>
	</define>
</composition>
```

The templating engine will make sure that this composition is converted to the view of [step 1](#Step_1:_Normal_views.md). At this point, it is of course very easy to create several other compositions out of the same template, e.g.:

```
<composition template="main">
	<define name="body">
		<p>This is some other page!</p>
	</define>
</composition>
```

## Step 3: Hierarchical templates ##

The nice thing about Movico templating is that it has support for multi-step templating, which means that compositions can be templates themselves for other views. This way you can setup a real hierarchy of templates and minimize the replication of content to the fullest.

To convert the previous example to a multi-tier templated page, the following files could be created. If you've understanded Movico templating up to here, this will just be a minor step.

### www/template/parent.xml ###
```
<template>
	<h1>My Application</h1>
	<insert name="content"/>
</template>
```

### www/template/main.xml ###
```
<composition template="parent">
	<define name="content">
		<h2>General information</h2>
		<insert name="body"/>
	</define>
</composition>
```

Notice here that, despite being a composition, `main.xml` is still stored inside `www/template` instead of `www/view`. Remind however that `www/view` should only contain views that can be directly visited. This is not the case for compositions that still contain insertion points, because they would have no value if not being referenced from a normal view.

### www/view/index.xml ###
```
<composition template="main">
	<define name="body">
		<p>This is my profile</p>
	</define>
</composition>
```

This is the only view that can be referenced directly. This view will be transformed into the view in [step 1](#Step_1:_Normal_views.md) in 2 templating steps. Evidently, more steps are possible. The sky is the limit, really.

# Technical solution #

Movico's templating engine is implemented inside the **ViewRenderer** class. See `lib/controller/ViewRenderer.php`.