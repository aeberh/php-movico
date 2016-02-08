Movico's Service Builder is a very powerful development aid. The only thing you need to write is an XML file that contains the definition of your entities. Based on this definition Service Builder will create model classes, database CRUD services, finders, ...

# Entity definition file #

Below you see an example of an entity class definition.

```
<service-builder>
    <entity name="User" table="myphpapp_user">
        <column name="id" type="int" primary="true" auto-increment="true"/>
        <column name="firstName" type="String" size="50"/>
        <column name="lastName" type="String" size="50"/>
    </entity>
</service-builder>
```

In this example we defined one entity named **User**. It has three fields: **id**, which is the primary key, **firstName** and **lastName**. Let's take a look at what Service Builder generates for us when we invoke it on this file:
  * **tables.sql**: SQL table creation script
  * **UserModel**: abstract POPO (plain-old PHP object) with getters and setters for all properties
  * **User**: extends UserModel with custom domain object methods
  * **UserPersistence**: low-level CRUD operations implemented as SQL queries
  * **UserServiceBase**: abstract service class with default service methods and finders
  * **UserService**: extends UserServiceBase with custom service methods
  * **UserServiceUtil**: to be called by the developer in Backing Beans

## tables.sql ##

Service Builder creates a MySQL table creation script based on the entities and columns defined.

```
CREATE TABLE `myphpapp_user` (
    `id` INTEGER unsigned NOT NULL AUTO_INCREMENT,
    `firstName` VARCHAR(50) NOT NULL,
    `lastName` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`id`)
);
```

## UserModel ##

**UserModel** is an abstract class that encapsulates the fields id, firstName and lastName and provides public getters and setters for them. Each model extends the Model superclass. As a developer you will never modify this class, as it gets overwritten each time you run the Service Builder.

```
<?
abstract class UserModel extends Model {
   
    private $id;
    private $firstName;
    private $lastName;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    // ...

}
?>
```

## User ##

UserModel is an abstract class and thus cannot be instantiated. Subclass **User** is an instantiable class that extends the UserModel abstract class. This means that it inherits all property getters and setters. This is the class where your custom methods should be implemented.

```
<?
class User extends UserModel {

    public function getFullName() {
        return $this->getFirstName()." ".$this->getLastName();
    }

}
?>
```

## UserPersistence ##

UserPersistence contains the low-level CRUD (create/read/update/delete) operations for the entity. The Persistence abstract superclass encapsulates a (singleton) DatabaseManager object that is used to run queries against. Persistence classes are the only classes that deal directly with SQL. As a developer you will never modify this class, as it gets overwritten each time you run the Service Builder.

```
<?
class UserPersistence extends Persistence {
    
    const TABLE = "myphpapp_user";

    public function findByPrimaryKey($id) {
        $result = $this->db->selectQuery("SELECT * FROM myphpapp_user WHERE id='$id'");
        if($result->isEmpty()) {
            throw new NoSuchUserException($id);
        }
        return $this->getAsObject($result->getSingleRow());
    }

    //...

}
?>
```

## UserServiceBase ##

The UserServiceBase class embeds the accompanying UserPersistence class and passes its calls to that class. The reason for this is for the UserService class (that implements the UserServiceBase class) to use the basic CRUD operations and finders. As a developer you will never modify this class, as it gets overwritten each time you run the Service Builder.

```
<?
abstract class UserServiceBase {

    public function getUser($id) {
        return $this->getPersistence()->findByPrimaryKey($pk);
    }

    // ...

    private function getPersistence() {
        return Singleton::create("UserPersistence");
    }

}
?>
```

## UserService ##

The UserService class extends UserServiceBase for the developer to implement additional service methods that can use the CRUD and finder operations, defined in UserServiceBase.

```
<?
class UserService extends UserServiceBase {

    public function create($firstName, $lastName) {
        $user = $this->createUser();
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        return $this->updateUser($user);
    }

}
?>
```

In this case we created a custom user creation service that uses the `createUser()` and `updateUser()` operations provided by UserServiceBase.

## UserServiceUtil ##

UserServiceUtil provides easy access to the UserService without having to worry about instantiation or singletons. It encapsulates a UserService object and passes all calls to this singleton object. As a developer you will never modify this class, as it gets overwritten each time you run the Service Builder.

```
<?
class UserServiceUtil {

    public static function getUser($pk) {
        return self::getService()->getUser($pk);
    }

    // ...

    private static function getService() {
        return Singleton::create("UserService");
    }

}
?>
```

When you've created custom services in UserService and run the Service Builder again, the methods will automatically appear as static methods in UserServiceUtil.

# For the developer #

Implementing all those classes seems like a lot of work, right? Not! If you take another good look at the classes Service Builder generates, there are only _two_ classes that need to be modified by the developer:
  * **User**: implementing custom functionality on top of those in UserModel
  * **UserService**: implementing custom service methods on top of those in UserServiceBase

To put it in another way: Service Builder leverages the Movico developer in writing boring code, gaining more time for the more interesting stuff!

# Read more #
Read about
  * Finder methods
  * Other