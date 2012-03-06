# NOTE

For development environment specific settings to apply,
make sure your url starts with `localhost.`.

	ex:
		http://localhost.garagesale.com/


# INSTRUCTIONS

1. **Setting Up Your Local Configuration**

	Duplicate `/protected/config/local.php.sample` to `/protected/config/local.php`
		then update it to match your local environment configuration.

2. **Setting Up the Database**

	Rename `/db_rebuild.php.danger` to `/db_rebuild.php`
		then run `/db_rebuild.php` in your browser for a clean database
			or `/db_rebuild.php?populate` for a populated one.

	ex:
		http://localhost.garagesale.com/db_rebuild.php?populate

3. **Applying Database Updates**

	For Mac users:
		Run `$ protected/yiic migrate` in your local repository.
  	For Windows users:
  		?

4. **Applying Correct File Permissions**

	For Mac users:
		Run `$ bash mac` in your local repository.