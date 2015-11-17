<!DOCTYPE html>
<html>
    <head>
        <style>
            body {
                background-color: <?php echo $theme_options['theme_background']; ?>;
                margin: 0px;
            }
            body, th, td, input {
                font-family: verdana;
                font-size: <?php echo $theme_options['theme_font_size']; ?>px;
                line-height: <?php echo $theme_options['theme_font_size']*1.3; ?>px;
            }
            h1 {
                background-color: <?php echo $theme_options['theme_title_background']; ?>;
                color: <?php echo $theme_options['theme_title_color']; ?>;
                font-size: 1.2em;
                border-bottom: 1px solid #999;
                box-shadow: 0 1px 2px #999;
                padding: 10px;
                margin: 0 0 15px 0;
            }
            #message {
                margin: 10px;
            }
            input {
                padding: 5px;
                border-radius: 3px;
                border: 1px solid #ddd;
            }
        </style>
    </head>
    <body>
        <h1><?php echo $theme_options['theme_title']; ?></h1>
        <div id="message">
        <?php echo $message; ?>
        </div>
    </body>
</html>