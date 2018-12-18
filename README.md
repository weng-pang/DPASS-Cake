# DPASS CakePHP

This DPASS application is built from [CakePHP 3.x](https://cakephp.org) .

## Operation (Development Only)

The web server can be run directly from the framework using this command:

```bash
bin/cake server
```

In case there are more than one built-in server, run this command (using a different port number) instead:

```bash
bin/cake server -p 8700
```
## Clear Cache
This command may be used when updating the translation file.
The cache may be cleared via making this command
``bash
bin/cake cache clear_all
``

## Configuration

Read and edit `config/app.php` and setup the `'Datasources'` and any other
configuration.

## Layout

The app skeleton uses a subset of [Foundation](http://foundation.zurb.com/) (v5) CSS
framework by default. You can, however, replace it with any other library or
custom styles.
