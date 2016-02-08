# GET requests #

GET requests can be triggered by entering a URL inside the browser or by clicking on a RenderLink component. An example of a URL in Movico:

> http://localhost/movico/users/show_profile/p/123

This URL consists of 4 parts:
  * The **hostname**. This part identifies your server, in this case **localhost**
  * The **context path**. This is the directory in which your application is installed. It can be omitted if the application is installed in the docroot of your webserver. The context path must be configured in main.conf. In this case the context path is **/movico**
  * The **view**: The view identifies which view XML should be displayed on the page. It is the part behind the context path, if any, and before the /p/ delimiter. In this case, the view is **users/profile**
  * The **view parameters**. In some cases you want your view to depend from some parameters. In this case, there is a view parameter that holds the ID for the user I want to show the profile for. So the view parameter list is a singleton **123**.

Based on the information contained in the URL, Movico will move through the following steps:
  1. The .htaccess file will convert the URL to http://localhost/movico?u=users/show_profile/p/123
  1. The ActionController will split the view from its parameters using the /p/ delimiter.
  1. The concerning view is parsed

# POST requests #

POST requests can be triggered by clicking on a CommandButton or a CommandLink.


# Details #

Add your content here.  Format your content with:
  * Text in **bold** or _italic_
  * Headings, paragraphs, and lists
  * Automatic links to other wiki pages