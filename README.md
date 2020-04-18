# Zen-PHP

Zen-like (or Emmet) functionality for PHP.

Pass a string for the command formatted like this:

``` sh
zen-php 'zen-property+;function'
```

would generate

``` php
class Zen {

   private $property;

   public function function() { }
}
```


Don't forget to quote. Shells use semicolons.

`+` is public, `-` is private (both for methods/functions)
`;` for methods (functions);

- TODO: Set this for composer global usage.
- TODO: Publish Emacs Package Integration.
- TODO: Extend a Class.
- TODO: Protected properties
- TODO: Types [string, array, ...]? 
