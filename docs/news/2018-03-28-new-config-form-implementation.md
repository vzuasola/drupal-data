# New Implementation for Drupal Configuration Forms

It is recommended that newer features will implement the new configuration form plugin.
You can read more about the [plugin here](../../docs/webcomposer-config-plugin.md)

# List of Changes

* Addition of **Webcomposer Config Plugin** support
* Rework of **Webcomposer Config** common configuration forms
* Addition of **Audit Log** support for content and config entities
* Deprecation of old Webcomposer Config forms
* Migration of Webcomposer Config forms to Webcomposer Config Plugin

# Important Post Deployment Steps

Coupled up with these changes are multiple feature enhancements and reworks that
needs additional post deployment steps.

* Deploying this change to production requires a **clear cache** for **all product instances**

# Important Migration Steps

Once you get this update for your product site, you need to **migrate** immediately.

### The required migration steps are:

* Enable the **webcomposer_config_schema** and **webcomposer_dashboard** module
* Clear cache
* Commit the generated configs

> It is important to enable these modules as soon as possible, as future Webcomposer
> functionality will require the existence of these modules

### Optional migration steps:

These steps are optional, but you will mostly likely need to do so.

* Migrate all site specific configuration forms to **Webcomposer Config Plugin**

Without this optional migration steps, your custom config forms will not get
registered on the audit logs. And you won't reap the advantages that
the Webcomposer Config Plugin offers.
