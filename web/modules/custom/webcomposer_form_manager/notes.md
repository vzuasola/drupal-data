# Implementations Notes

* Translatability of Enable/Disable validation flags

Since we are using configs, in a sense everything is persisted to a language as a snapshot. Since the
validation flags is part of that snapshot, I did some things to override this behavior.

When I save in EN, I save all configs. But when I try to translate and save it, I modify
first that config data by unsetting the validation flags. So that for EN (default language)
the validation flag is set, but for translations, it will not be there.

On the Settings class (the class that exposes data to the Rest Resource `src\WebcomposerFormSettings.php`), 
I made an alter that will fetch the validation data from EN, then merge it to the config snapshot
to a specific language before returning it.
