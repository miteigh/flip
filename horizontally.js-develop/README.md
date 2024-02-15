# Horizontally.js

<img src="logo.svg" alt="Markdown Monster icon" width="200" style="margin-bottom: 10px" />

<strong>Horizontally.js</strong> is a lightweight JavaScript library that creates full page, responsive, slideshow/carousel web applications with mouse and touch scroll support.

For further instructions and examples make sure to read our <a href="https://matthewbleuk.github.io/horizontally.js-docs/" target="_blank">documentation web page</a>.

Take a look at our <a href="https://codepen.io/matthew98/pen/poQeapN" target="_blank">CodePen demo</a>

# Contents

-   [Personal License](#Personal-License)
-   [Commercial License](#Commercial-License)
-   [Usage](#Usage)
-   [NPM Usage](#NPM-Usage)
-   [CDN Usage](#CDN-Usage)
-   [Options](#Options)
-   [Contributors](#Contributors)

# Personal License

Horizontally.js is released under the GNU General Public License v3 for open-source personal projects.

This means you are free to modify and distribute under the GPL license if the copyright and credits notices remain untouched.

View this [resource](https://choosealicense.com/licenses/gpl-3.0/) for more information on the GPL License.

# Commercial License

For commercial uses such as non open-source sites, website templates, and other types of web applications a commercial license is needed.

<!-- For more information on commercial licenses, take a look at our site ().  -->

# Usage

To use Horizontally.js you must include the css and javascript files, add the correct HTML structure, and initialize the project.

### Including CSS and Javascript files:

```html
<link rel="stylesheet" type="text/css" href="horizontally.css" />

<script type="text/javascript" src="horizontally.js"></script>
```

### HTML structure:

```html
<div id="horizontally">
    <div class="section"></div>
    <div class="section"></div>
    <div class="section"></div>
</div>
```

### Initialize project:

```javascript
new horizontally({
    wrapper: "#horizontally",
    speed: 1000,
    arrowButtons: true,
    pageSelector: true,
});
```

### Add CSS styles:

If this is your first time using horizontally.js, you may want to add CSS styles to the sections to visually represent them.

```css
.section:nth-child(1) {
    background: #2196f3;
}

.section:nth-child(2) {
    background: #4caf50;
}

.section:nth-child(3) {
    background: #ffc107;
}
```

# NPM Usage

Horizontally.js is also available on NPM and can be installed via the command line. When using NPM the CSS and JS files need to be included/imported for the package to work correctly.

```
npm install horizontally.js
```

# CDN

Alternatively, it is possible to use our CDN.

```
https://cdn.jsdelivr.net/gh/MatthewBleUK/horizontally.js@latest/src/css/horizontally.css

https://cdn.jsdelivr.net/gh/MatthewBleUK/horizontally.js@latest/src/js/horizontally.js
```

# Options

Horizontally can be used with four options.

The wrapper option changes the HTML ID name of the wrapper. The default option is #horizontally.

```javascript
wrapper: "#horizontally";
```

The speed option changes the scroll milliseconds duration. To prevent users from accidentally scrolling twice, a speed above 300ms is a good choice. The default scroll speed is set to 1000ms.

```javascript
speed: 1000;
```

The arrowButtons option enables or disables the DOM onscreen arrow buttons.

```javascript
arrowButtons: true;
```

The pageSelector options enables or disables the DOM circle page selector / navigation buttons.

```javascript
pageSelector: true;
```

# Contributors

All contributors (regardless of the skill level) are welcome. A detailed list of all the future features and bugs can be found inside the issues tab.

Simply fork the project, send a PR request when you are done, and I will review it.
