# Changelog

All notable changes to this project will be documented in this file.

The format is based on
[Keep a Changelog](http://keepachangelog.com/en/1.0.0/ "The Keep a Changelog website")
and this project adheres to
[Semantic Versioning](http://semver.org/spec/v2.0.0.html "Semantic Versioning 2.0.0 specification").

## [1.4.0] - 2018-03-15
### Added
- There is now an administration area.
- New partners can be added using a dedicated tool in the administration area.

### Changed
- Improved two million things while working on the new tool to add partners.

## [1.3.0] - 2018-01-11
### Changed
- Currency exchanges are now sorted by the ‘sort name’ of the partner.
- The page for ‘apéros’ now has ‘real’ content.

## [1.2.0] - 2017-12-06
### Added
- The home page can now display the bills of any region. On each page load, a region is choosen at random.
- Add real content to ‘Le projet’ page.
- The page listing currency exchanges is now dynamic, getting its data from the database.
- Improve backwards compatibility of some parts of the layout.
- Add support for teams. Each team can have members.
- Partners can be linked to the team member who made them sign official documents.

### Changed
- On small viewports, on all pages except the home page, where the previous layout is kept, the site title and logo are now located in the header, above the main menu.

## [1.1.0] - 2017-10-31
### Added
- Partners now have a validation state. They can be valid or not.
- Improves performance when retrieving the list of partners.

## 1.0.0 - 2017-10-26
### Added
- Home page of the site.
- A page listing existing currency exchanges (hardcoded).
- A page listing active partners of the currency (dynamic).

[Unreleased]: https://github.com/monnaie-valheureux/radisse/compare/v1.3.0...HEAD
[1.4.0]: https://github.com/monnaie-valheureux/radisse/compare/v1.3.0...v1.4.0
[1.3.0]: https://github.com/monnaie-valheureux/radisse/compare/v1.2.0...v1.3.0
[1.2.0]: https://github.com/monnaie-valheureux/radisse/compare/v1.1.0...v1.2.0
[1.1.0]: https://github.com/monnaie-valheureux/radisse/compare/v1.0.0...v1.1.0
