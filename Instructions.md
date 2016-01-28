# Basic instructions #

Before using Shifter, you must add the following lines to your web page's `head` section. Don't forget to change include paths. NOTE: I've included the required javascript libraries for your convenience. But you don't have to add them if you have the required versions included already.

```
<link rel="stylesheet" type="text/css" href="styles/shifter.css" />
<script type="text/javascript" src="scripts/prototype.js"></script>
<script type="text/javascript" src="scripts/scriptaculous.js?load=effects"></script>
<script type="text/javascript" src="scripts/shifter.js"></script>
```

Now the only thing thats left is the code below. Copy it to the web page you're going to use Shifter. Change the `someAjaxUrl` to real path where your ajax script relies. You can provide various options (OptionList) in `{}` placeholder. Use comma to separate them.

```
<div>
  <div id="backward">Backward</div>
  <div id="forward" >Forward</div>
</div>

<div id="wrapper">
  <div id="container">
  </div>
</div>

<script type="text/javascript">
  document.observe('dom:loaded', function() {
    new Shifter("someAjaxUrl", {duration: 0.5});
  });
</script>
```

Please use provided php classes for desired Shifter functioning. And here's a quick example of carousel php script:

```
<?php
/* Required */
session_start(); 

/* Path to the carousel class. Change to fit. */
require_once 'classes/carousel.class.php';

/* Create carousel object with parameters. Change only the first value */
$carousel = new carousel(10, $_GET['preload'], $_GET['direction']);

/* Get new position */
$position = $carousel->getPosition();

/* An example how to use position for image loading */
echo "<img style=\"border: 1px solid black; margin: 0px 2px;\" src=\"images/" . $position . ".jpg\" />";
?>
```

Here's the necessary css style code for shifter to work. NOTE: There are no special eyecandy styles provided except the required ones for script to work.

```
#wrapper {
  width: 306px; /* Main container width. Set it to your preferences. */
  overflow: hidden; 
  position: relative;
}

#container {
  width: 10000px; /* Hidden container width. Should be more than 5 * #wrapper width. Most of the time no need to change. */
}

.frame {
  float: left;
  width: 306px; /* Should be the same as the #wrapper width */
}
```

You can find all of this code in demo files, which are provided with the package. If you have trouble figuring out how to use, please post your detailed problem in the [discussion groups](http://groups.google.com/group/ajax-based-content-shifter-discussions)