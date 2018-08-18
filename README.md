# photo-gallery
Displays all media from a folder.

### Usage
In `index.php`, change the `subdomain` variable to a string containing the name
of whatever subdomain you plan on deploying to on your server. If you aren't
putting it in a subdomain or are just running it locally, you can skip this step
and just leave it as an empty string.

Put all the images you plan on using in a folder named `content`.

### Bugs
Sometimes the page loads all the images as squares instead of with the proper sizing for their
orientation. Usually refreshing the page once solves this. Might switch Masonry from a 
local dependency to the online script to try to fix this, as Masonry loading in late 
may be the problem.

### Plans
- Possibly remove Masonry from dependencies
- Add settings/options for different sizes and display styles
