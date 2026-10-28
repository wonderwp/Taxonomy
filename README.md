# WonderWp Taxonomy Component

A WonderWp package allowing you to manage Taxonomys.

## Documentation

- Documentation about the Taxonomy component can be found [here](http://wonderwp.net/Creating_a_plugin/Taxonomies/index.html).
- Testing strategy: [wonderwp/docs/testing.md](https://github.com/wonderwp/wonderwp/blob/chore/deps-max/docs/testing.md)

## Testing

### Unit (CI)

```bash
composer install
composer test
```

### Integration (WordPress host)

```bash
wp eval-file vendor/wonderwp/taxonomy/tests/Integration/smoke-taxonomy-register.php
ddev wp eval-file vendor/wonderwp/taxonomy/tests/Integration/smoke-taxonomy-register.php
```
