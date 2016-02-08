# Conventions #

Many frameworks, not only in PHP, require the developer to write large and complicated configuration files. Movico tries to limit the use of configuration files as much as possible. Why?
  * Reading configuration files is slow
  * Developers soon lose oversight in large, distributed and complicated configurations
  * Most configuration properties never change, so why they should be configurable in the first place?

## Example ##

An ideal example for this is the lack of a `faces-config.xml`-like configuration file. Let's compare how JSF configures its beans and navigation rules, and how Movico does.

| **Action** | **JSF** | **Movico** |
|:-----------|:--------|:-----------|
| Bind the value of a component to a bean property. | Configure a managed bean in `faces-config.xml` to map the bean's class name to a reference that is used in the view. | Use directly the bean's class name inside the view. |
| Configure a scope for a backing bean. | Configure the scope of the backing bean inside `faces-config.xml`. | The bean itself extends `RequestBean`, `SessionBean` or `ApplicationBean`.  |
| Navigate to a view after execution of an action method. | Map a String value, that is returned inside the action method, to the next view, possibly using the view the user came from | Just return the new view directly inside the action method. If needed, the current view can be retrieved from the abstract BackingBean superclass. |
| Setup a welcome view. | Do a Javascript or meta redirect from an index.jsp to the first view. | `index.xml` is the welcome view. |