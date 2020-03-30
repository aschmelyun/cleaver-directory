# Cleaver Directory

[![Current Version](https://img.shields.io/packagist/v/aschmelyun/cleaver-directory.svg?style=flat-square)](https://packagist.org/packages/aschmelyun/cleaver-directory)
![License](https://img.shields.io/github/license/aschmelyun/cleaver-directory.svg?style=flat-square)
[![Build Status](https://img.shields.io/travis/aschmelyun/cleaver-directory/master.svg?style=flat-square)](https://travis-ci.org/aschmelyun/cleaver-directory)
[![Total Downloads](https://img.shields.io/packagist/dt/aschmelyun/cleaver-directory.svg?style=flat-square)](https://packagist.org/packages/aschmelyun/cleaver-directory)
[![Netlify Status](https://api.netlify.com/api/v1/badges/45105de1-fbc1-49e1-a7b7-14069b881e58/deploy-status)](https://app.netlify.com/sites/happy-perlman-16e9cc/deploys)

:fire: A blazing-fast static site generator for local directories built with PHP and Laravel's Blade, leveraging JSON or Markdown files for super-extensible content.

```bash
composer create-project aschmelyun/cleaver-directory your-site-name
```

## Why build this

During the COVID-19 outbreak, I really wanted to utilize my skills and provide my community with something that could be used for a positive purpose. I decided that a directory showcasing local restaurants that are still open, serving take-out and curbside pickup, would be the perfect use of my time.

I decided to use my previously-built static site generator Cleaver as the base for this project, modifying and adding functionality, a base layout, and example content.

This way, developers of any experience can clone this project for their area, use Markdown to easily add restaurants or businesses, and deploy the whole thing on a service like [Netlify](https://netlify.com) for **absolutely no cost**. 

## Requirements
- PHP 7.1 or higher
- Fairly recent version of node + npm 

## Installation

After creating your project with Composer, cd inside your project's root directory and install node dependencies:

```bash
npm install
```

From there you can build the demo site using the included example content, which outputs to a `dist/` folder in your project root:

```bash
npm run dev
```

## How the directory is structured

Just like with the main Cleaver generator, Cleaver Directory uses a `resources/content` directory to hold Markdown or JSON files that makeup your site. 

By default, there's a nested folder called `listings`, and this is where you should add in your shops, restaurants, and other businesses in your directory. When rendering a site, the framework will look for content that uses the `layout.listing` view, and passes this array of listings to the index view.

Individual listing pages are built from the content files in that `listings` directory. Inside each one, the following variables are required in addition to the view and path on all Cleaver content pages:

- title
- address
- city
- state
- lat
- long

See an example content page [here](https://github.com/aschmelyun/cleaver-directory/blob/master/resources/content/listings/taco-dive.md), and further documentation on the main [Cleaver documentation](https://usecleaver.com/docs/) page.

You can also have plain content pages (see `submit.md` as an example), that you can use for informational pages, contact areas, FAQ, and more.

## Modifying your assets

Cleaver uses SCSS for styling, and there's a basic skeleton structure set up in the `resources/assets/sass` directory. Tailwind is imported by default so you can jump right in to rapid development and prototyping.

There's a bootstrapped JavaScript file that imports lodash, jQuery, and Vue dependencies through npm to use with your project. That can be modified by editing the `resources/assets/js/app.js` file.

## Building the site

To compile the SCSS/JS assets and build the static site files, you can run `npm run dev` from the root. Additionally, using `npm run watch` starts up a local node server that you can use to view your compiled project, and will watch the entire `resources/` directory for changes to any assets, views, or content files.

If you would like to build your site without compiling the assets, run the `php cleaver` command from the project root.

## Publishing your site

Once you're ready to publish your site, simply run the command:

```bash
npm run production
```

Which will minify your assets and build the site again with the new versioned files.

You can then publish your entire project to a host of your choice as long as the web root is pointed to the `/dist` folder. Additionally, you're free to just publish the built files in the dist folder by themselves.

## Contact Info

Have an issue? Submit it here! Want to get in touch or recommend a feature? Feel free to reach out to me on [Twitter](https://twitter.com/aschmelyun) for any other questions or comments.

## License

The MIT License (MIT). See [LICENSE.md](https://github.com/aschmelyun/cleaver/blob/master/LICENSE.md) for more details.