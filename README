# ncTrackerPlugin

This plugin provides a tracking mechanism for actions performed or visited on
the application.

## Configuration

All you need to do to have user actions tracked is add a filter to your
`filters.yml` configuration file:

        security:  ~

        # Add this filter after the security key
        nc_tracker:
          class: ncTrackerFilter

By default, all actions will be tracked, but this can be easily customized by
adding some configuration parameters in the application's `app.yml` file:

        all:
          nc_tracker_plugin:
            track_non_secure: true  # Whether non-secure actions will be tracked
            track_errors:     true  # Whether 404 errors should be tracked
            track_ajax:       true  # Whether XMLHTTPRequests should be tracked
            register_routes:  true  # Whether routes for admin module should be
                                    #   automatically registered.


## Preventing specific actions from being tracked

Aside from the plugin's configuration, you can specifically state which actions
should or should not be tracked. The way to do this is by adding a `isTrackable`
method to your actions class that returns `true` if the action should be tracked
or `false` if it shouldn't.

        public function isTrackable()
        {
          return false;
        }

If such method does not exist, the configuration of the plugin will determine
whether the action is trackable or not.

For your convenience, an actions abstract class is included in the plugin for
those modules that shouldn't be tracked: `ncIncognitoActions`. Just extend that
class in your actions class and no action for that module will be tracked.

        class my_moduleActions extends ncIncognitoActions
        {
          // The actions for this module won't be tracked
        }


## Further customization

Enable the `nc_tracker_entry` module for your application in your `settings.yml`
file.

        enabled_modules: [default, nc_tracker_entry]

If you need it, you may secure the module by creating a `nc_tracker_entry`
directory in your application's `modules` directory (not creating the whole
module) and creating inside of it some files so that the whole structure matches
the following structure:

        %SF_ROOT_DIR%/
          app/
            my_application/
              modules/
                nc_tracker_entry/       # The (incomplete) module
                  config/               # Its config folder
                    security.yml        # The security configuration file


## Module / Action names translation

You may want translate the name of your modules and actions to make them more
user-friendly. Lucky for you, this can be easily done! Just create an i18n
catalogue named `modules` to translate the module names, and/or another one
named `actions` to translate your actions.
