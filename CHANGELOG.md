# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added

-   Add Mustache Template Engine library dependencies.
-   Add Mustache classes and render function to Base Controller.
-   Add Mustache Filters to use in templating.
-   Add Template Partials to Modularize HTML.

### Changed

-   Update Home Controller to use render function.
-   Rename welcome_message.php to welcome_message.mustache.
-   Convert welcome_message.mustache to child of layout.mustache.

## [1.0.0] - 2022-08-07

**Initial commit**

[unreleased]: https://github.com/ManuelGil/ci4-template-engine/compare/v1.0.0...HEAD
[1.0.0]: https://github.com/ManuelGil/ci4-template-engine/releases/tag/v1.0.0
