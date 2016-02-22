# PommFosUserBundle

FosUserBundle driver for PommProject 2

This bundle permit to use FosUserBundle with Pomm easily.

## Installation

With composer :
```
composer require vibby/pomm-project-fos-user-bundle ~2.0
```

You can execute [SQL script](src/lib/Resources/database/tables.sql) to create table.
It's an example to use with default configuration.

You use another table's name with `pomm_fos_user.table_name` parameter.

## Configuration

In `app/config/config.yml` add configuration below :

```
parameters:
    pomm_fos_user.connection_name: '%YOUR_DATABASE_CONNECTION%'   # Default is "default"

fos_user:
    db_driver: custom
    firewall: main
    user_class: Vibby\PommProjectFosUserBundle\Model\User
    service:
        user_manager: pomm_fos_user_bundle.user_manager
```

And that's all.

## Overriding

It's possible to inherit `Vibby\PommProjectFosUserBundle\Model\User` on your own bundle to override this model.
