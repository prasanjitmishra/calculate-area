# calculate-area
Framework used - Laravel 5.4
frontend -JQuery

FAQ
How to Set up Project?
- Put the code in your web root directory
- Do composer install
- give right access to project folder and subfolders by running command 'chown -R www-data:www-data projectname/'
- Now please put this in browser to load page "localhost/projectName/public/shapes"

How will add more Shapes?

1) add a radio button to resources/views/Shapes/selectShape.blade.php

2) create a class inside 'app/Shapes' named same as the value property of shape you added in step 1 with first letter capital.
 (e.g rightangledtriangle -> Rightangledtriangle.php)

3) create two functions getAttributes(), calculateArea() and validate($data)
Note:Ple