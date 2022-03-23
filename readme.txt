=== Tangles Events ===
Contributors:   tangles_events
Tags:           events, calendar, event
Donate link:    https://www.tanglesevents.com/contribute/
Tested up to:   5.9
Stable tag:     0.1.3
License:        GPL-3.0-or-later
License URI:    https://www.gnu.org/licenses/gpl-3.0.html

The Tangles Events plugin fetches pulic event information from a Tangle Events community and renders as a calendar widget.

== Description ==
The plugin connects to your Tangles Events community to retreive current and upcoming events and displays them in a simple
paginated calendar view eithe rusing a Wordpress widget or a Gutenberg block.

== Installation ==

1. More detailed steps are also avaialble at https://www.tanglesevents.com/help/wordpress/
1. Upload the plugin files to the `/wp-content/plugins/tangles-events` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Login on to your Tangles Events community or register at https://www.tanglesevents.com/ and create a new community
1. Navigate to the community 'Directories' and add a Wordpress directory listing to be used with this Wodpress site. Each site must have its own directory listing.
1. Retrieve the public key from the newly created directory listing and insert this in the public key field of the Worpdress widget or block
1. From your Tangles Events community page, select which live and upcoming events to include in the directory:
2. Navigate to the events that you wish to include and select 'Directory entries' and add a new entry for the Community directory listing that you just created.

== Source code ==

1. Source code for the plugin can be found at https://github.com/tintabeeltd/tangles-events-wordpress-plugin
1. To build the plugin, install the wordpress script tools using npm and use these to build the plugin zip file

npm install @wordpress/scripts
npm run build
npm run plugin-zip

== Changelog ==

= 0.1.1 =
* Release
