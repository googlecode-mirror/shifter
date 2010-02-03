<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Shifter Demo</title>
    <link rel="stylesheet" type="text/css" href="styles/shifter.css" />
    <script type="text/javascript" src="../scripts/prototype.js"></script>
    <script type="text/javascript" src="../scripts/scriptaculous.js?load=effects"></script>
    <script type="text/javascript" src="../scripts/shifter.js"></script>

    <script type="text/javascript">
      document.observe('dom:loaded', function() {
        new Shifter("<?php echo !isset($_GET['type']) ? 'carousel' : $_GET['type']; ?>.php", {});
      });
    </script>
  </head>

  <body>
    <div style="width: 600px;">
      <p>
        Here's a simple demo of both carousel and glider algorithms. Just select what you wish to view and
        click "Change". After that - click arrows to see how it works.
      </p>

      <ul>
        <li>
          There are 10 images provided for the Carousel algorithm.
        </li>
        <li>
          Glider just returns the position of the shown element.
        </li>
      </ul>

      <p>
        <strong>NOTE:</strong> There is no special style provided. Just a simple demo.
      </p>
    </div>

    <div style="margin: 0 auto; width: 306px;">
      <form method="get" action="">
        <fieldset>
          <legend>Change algorithm type</legend>
          <label for="type_carousel">Carousel</label>
          <input type="radio" id="type_carousel" name="type" value="carousel"
                 <?php echo ((isset($_GET['type']) && $_GET['type'] == 'carousel') || !isset($_GET['type'])) ? 'checked="checked"' : ''; ?> />
          <label for="type_glider">Glider</label>
          <input type="radio" id="type_glider" name="type" value="glider"
                 <?php echo (isset($_GET['type']) && $_GET['type'] == 'glider') ? 'checked="checked"' : ''; ?> />
          <input type="submit" value="Change" />
        </fieldset>
      </form>

      <div style="height: 20px;">
        <div id="backward" style="float: left; cursor: pointer; font-weight: bold;">&lt;&lt;&lt;</div>
        <div id="forward" style="float: right; cursor: pointer; font-weight: bold;">&gt;&gt;&gt;</div>
      </div>

      <div id="wrapper">
        <div id="container">
        </div>
      </div>
    </div>
  </body>
</html>

