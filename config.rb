require 'susy'
css_dir = (environment == :production) ? "assets/css/temp" : "assets/css"          #where the CSS will saved
sass_dir = "assets/css/sass"           #where our .scss files are
javascripts = "assets/js"
images_dir = "assets/images"
fonts_dir = "assets/fonts"
output_style = (environment == :production) ? :compressed : :nested
relative_assets = true
