# Hide User Age

Hide users' age and birth year from other users. Birth month and day can still be set, and user birthdays will still be displayed, unless disabled elsewhere.

## Installation

Copy the extension to phpBB/ext/luoning/hideuserage

Go to "ACP" > "Customise" > "Extensions" and enable the "Hide User Age" extension.

## License

[GNU General Public License v2](license.txt)

## Limitations

Users can still technically set their own birth year via browser dev tools, but it will never be visible to other users unless the extension is removed or disabled. Birth year data for users that set their own birth years before the extension was installed/enabled will be retained, but never displayed; the extension does not affect any existing data.

To delete _all_ user birth years from the database, you can run the following SQL (**NOTE**: not rigorously tested, run at your own risk):

```sql
UPDATE `phpbb_users`
SET `user_birthday` = CONCAT(SUBSTRING(`user_birthday`, 1, 6) , '   0')
WHERE `user_birthday` != '';
```
