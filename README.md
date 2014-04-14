* Integration: `http://int-stycle.pajaroncreative.com/`
* Staging: `http://sta-stycle.pajaroncreative.com/`
* Production: `http://stycle.pajaroncreative.com/`

# INSTRUCTIONS

1. **Setting Up Your Local Configuration**

	(Optional) Copy cPanel-email-account-manager.php into a different subdomain in your server
		then update it to match your cPanel configuration.

	Change pipe.php permissions to 777.

	Duplicate `/protected/config/params.php.sample` to `/protected/config/params.php`
		then update it to match your local environment configuration.

	Duplicate `/img/vendor/slir/slirconfig-sample.class.php` to `/img/vendor/slir/slirconfig.class.php`
		then update it to match your local environment configuration.

2. **Setting Up the Database**

	Duplicate `/db_rebuild.php.danger` to `/db_rebuild.php`
		then run `/db_rebuild.php` in your browser for a clean database
			or `/db_rebuild.php?populate` for a populated one.

		ex:
			http://local.stycle.com/db_rebuild.php?populate

	Use this also to reset the database.

3. **Applying Database Updates**

	Running `/db_rebuild.php` automatically applies database updates.
	Use the following commands if you want to update the database without resetting it.

	OSX:

		Run `$ protected/yiic migrate` in your local repository.

4. **Applying Correct File Permissions**

	OSX:

		Run `$ bash osx` in your local repository.

# USERS

* u: `user` p: `password`
* u: `user2` p: `password`
* u: `admin` p: `password`
* u: `admin2` p: `password`
* u: `super` p: `password`
* u: `super2` p: `password`
* u: `hesedel` p: `password`

# PHamlP

**This section just references files and lines of code to be removed when all Haml files have been converted back to PHP.**

`/protected/extensions/phamlp/`

`/protected/config/main.php`:

	'viewRenderer'=>array(
		'class'=>'ext.phamlp.Haml',
		// delete options below in production
		'ugly' => false,
		'style' => 'nested',
		'debug' => 0,
		'cache' => false,
	),
