# blanq

WordPress theme that uses Twitter Bootstrap. Intended for custom theme development. [Bootswatch](https://github.com/thomaspark/bootswatch) compatible.

## Status

Alpha, not recommended for use in production.

#### Makefile

You will need at least the following to build the makefile

* jshint
* less
* uglifyjs

To install using [npm](https://npmjs.org/)

`npm install jshint -g
npm install less -g
npm install uglify-js -g`

Then just run `make` from within the theme directory.

## Acknowledgments

* [Twitter Bootstrap](http://twitter.github.com/bootstrap/)
* [_s (underscores)](http://underscores.me/)
* [Twenty Eleven by the WordPress team](http://wordpress.org/)
* [Extended Walker class](https://gist.github.com/3765640/e2e7d1c7bf7478c1fc0ebf443878f9c660f195d3) by [Emanuele Tessore](https://github.com/setola) ([forked](https://gist.github.com/1597994) from [John Megahan](https://github.com/johnmegahan))
* [Default Custom Menu](http://theme.it/quick-tip-how-to-generate-a-default-custom-menu/) technique by [Jason Schuller](http://twitter.com/jschuller) (with [modification](http://theme.it/quick-tip-how-to-generate-a-default-custom-menu/#comment-392) from [Melanie Karlik](http://www.karlikdesign.com/))
* [jQuery](http://jquery.com/)
* [Modernizr](https://github.com/Modernizr/Modernizr)
* [Normalize](https://github.com/necolas/normalize.css)
* [Less](https://github.com/cloudhead/less.js)

## Credits

This plugin is built and maintained by [da-n](https://github.com/da-n/). Contributions are very welcome.

## ToDo

* Check all views are Bootstrap compatible, feature parity with default themes.
* Use mixins so that default Bootstrap classes are not needed, to make it more semantic.
* Add a basic options page which has options for navbar, appearance etc.
* See if it is feasible to have a select option for Bootswatch themes.

## Changelog

#### 0.2.0
* Updated readme.

#### 0.0.1
* Initial release