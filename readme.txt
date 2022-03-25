=== Tangles Events ===
Contributors:      tintabeeltd
Tags:              events, calendar, event
Donate link:       https://www.tanglesevents.com/contribute/
Tested up to:      5.9
Requires at least: 5.8
Requires PHP:      7.0
Stable tag:        1.0.0
License:           GPL-3.0-or-later
License URI:       https://www.gnu.org/licenses/gpl-3.0.html

The Tangles Events plugin fetches public event information from an exsiting Tangle Events community (www.tanglesevents.com) and renders them as a calendar widget or block directly in your WordPress site.

== Description ==
The plugin connects to your existing Tangles Events community (https://www.tanglesevents.com/) to retrieve current and upcoming events and displays them in a simple paginated calendar view as a WordPress widget or a WordPress Gutenberg block. You control which events are included in the calendar from within your Tangles Events account.

Events are created and managed within the Tangles Events site (https://www.tanglesevents.com/). This plugin allows you to incorporate a public view of those events directly in the context of your WordPress site. You can also create and manage your Tangles Events community events via the Tangles Events mobile app.

The information used to create the calendar view using this plugin is kept in your Tangles Events community and is not replicated to the WordPress database

* If you don't already have one, you can create a Tangles Events account at https://www.tanglesevents.com/
* The terms of use governing Tangles Events accounts and information accessed via this plugin can be found at https://www.tanglesevents.com/terms-use/
* The privacy policy covering your use of Tangle Events can be found at https://www.tanglesevents.com/privacy-cookie-policy/

You can disconnect the link between your Tangle Events community and your WordPress site either by removing the relevant block or widget in WordPress or by removing the connection in Tangles Events

== Installation ==
1. More detailed steps are also available at https://www.tanglesevents.com/help/wordpress/
1. Install and activate the plugin through the WordPress plugins screen - Add new Plugin.
1. Login on to your Tangles Events community or register at https://www.tanglesevents.com/ and browse to an existing community or create a new one.
1. Navigate to the community's 'Directories' settings and add a new WordPress directory entry to be used with this WordPress site. Each site must have its own directory entry.
1. Retrieve the public key from the newly created directory listing and insert this in the public key field of the WordPress widget or block
1. From your Tangles Events community page, select which live and upcoming events to include in the directory. Navigate to the events that you wish to include and select 'Directory entries' and add a new entry for the Community directory listing that you just created.

== Frequently Asked Questions ==
= Is Tangles Events free ? =
* Tangles Events is an event management tool created originally for outdoor youth events although any community can use it for all kinds of events. It is free to use for small communities and supports any number of events and community members.
* Larger communities must have a license when they run events with numbers of participants over the free threshold. Creating community events and listing via this plugin is free to use.
* More details can be found one the Tangles Events website (https://www.tanglesevents.com)

== Screenshots ==
1. The Gutenberg block displays events ordered by month and date, with Live (currently active) events shown first. The layout includes the featured image and the event icon (if set)
2. The widget has the option to display the same layout as a block or on a compact form, omitting images etc.

== Source code ==
1. Source code for the plugin can be found at https://github.com/tintabeeltd/tangles-events-wordpress-plugin
1. To build the plugin, install the WordPress script tools using npm and use these to build the plugin zip file:
`npm install @wordpress/scripts`
`npm run build`
`npm run plugin-zip`

== Changelog ==
= 0.1.4 =
* WordPress.org plugin directory release
