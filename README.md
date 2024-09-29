# 🍁MPL🍁 Matomo Release Builder
This project rebuilds matomo releases into git tags so that matomo can more easily be installed via composer.

We recommend using this alongside [mpl/composer-plugin](https://github.com/PortlandLabs/mpl-composer-plugin/) which will
manage placing matomo into `/mpl-matomo`.

## Steps `./console build` takes to create a new tag

1. Determine the available versions via [matomo-org/matomo tags](https://github.com/matomo-org/matomo/tags)
2. Skip any versions that we already have a tag for in `/build`
3. Download the matching version release zip from https://builds.matomo.org
4. Download the matching `composer.json` from the github tag
5. For versions that support it:
   1. Download the matching `.asc` signature file from https://builds.matomo.org
   2. Verify the release zip signature using `gpg`
6. Unzip the zip into a unique directory in `/temp`
7. Apply our changes to the unzipped directory
   1. Delete the `unzip/vendor` directory
   2. Delete the `unzip/composer.lock` file if it exists
   3. Reinstate the `unzip/composer.json` file using what we downloaded from github
   4. Prepend `/overlay/README.md` to the `unzip/README.md` file
   5. Modify `unzip/composer.json` to have the proper `name` and type, and to `replace` `matomo/matomo`
   6. Modify the `unzip/config/manifest.inc.php` to remove and update files that were removed or modified in previous steps
8. Tag the new release in the `/build` directory:
    1. Create a new orphan branch using `git checkout --orphan $TAG`
    2. Delete any files that exist other than `.git`
    3. Copy in `unzip/*` to `/build`
    4. Add and commit all files
    5. Create a new tag with `git tag $TAG`

> [!IMPORTANT]
> This project generates unique commits per tag. If you intend to regenerate tags, you must rename existing branches to
> allow existing `composer.lock` files will continue to work.

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

