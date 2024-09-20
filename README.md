# Matomo Release Builder
This project rebuilds matomo releases into git tags so that matomo can more easily be installed via composer.

## Updating keys
To pull the keys run `./console keys`

## Updating tags

```shell
git clone git@my-git-repo:some/path build
./console build
cd build
git push origin --all
git push origin --tags
```

