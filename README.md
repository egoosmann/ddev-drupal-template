## Configure DDEV

```
ddev config --auto --additional-fqdns=localhost
ddev add-on get ddev/ddev-phpmyadmin
ddev start
```

## After installation
```
ddev scaffold-settings
ddev sync [USER] [HOST]
```
