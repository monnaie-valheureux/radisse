# Changelog

All notable changes to this project will be documented in this file.

The format is based on
[Keep a Changelog](http://keepachangelog.com/en/1.0.0/ "The Keep a Changelog website")
and this project adheres to
[Semantic Versioning](http://semver.org/spec/v2.0.0.html "Semantic Versioning 2.0.0 specification").

## [1.16.1] - 2018-11-26
### Fixed
- Moved `laravel/telescope` from a dev to a non-dev dependency to prevent loading errors because of its service provider not being present.

## [1.16.0] - 2018-11-26
### Added
- There is now a dedicated page for partners that have no explicit location.
- The site now has a proper favicon!
- Public pages now display the site’s version number in the footer.

### Changed
- The list of partners now lists cities instead of displaying all the partners at once. Once a city is chosen, the partners of that city are then shown.
- On public pages, ensure that the site footer will always ‘stick’ to the bottom of the screen even when there is not a lot of content on the page (‘sticky footer’).
- Updated content in the page for ‘apéros’.
- The application has been upgraded to Laravel 5.7.

## [1.15.0] - 2018-10-22
### Changed
- Updated content in the page for ‘apéros’.
- Currency exchanges can now be soft-deleted, and a reason for deletion can be specified in the table.
- Improved the page of currency exchanges, which now groups them by city and provide links to the related partners’ pages.

## [1.14.0] - 2018-10-04
### Changed
- Updated content in the page for ‘apéros’.

## [1.13.0] - 2018-09-28
### Added
- Former partners are now listed on a dedicated admin page. As a result, they have been removed from the main list of partners, which now only lists the active ones.

## [1.12.0] - 2018-09-03
### Added
- Partners now keep track of the team members who created them.
- Added a quick-access list to non-validated partners in the administration area.

### Changed
- Updated content in the page for ‘apéros’.
- Improved handling of partners with incomplete data in the administration area.

## [1.11.0] - 2018-08-20
### Added
- Added a site-wide announcement system, which can be used to get peoples’s attention and direct them to a specific page containing more information about a given topic.
- (on the server) Added a strict Content Security Policy.
- (on the server) Added a same-origin Referrer Policy.

### Changed
- Public pages do not use any cookie any more 🍪🔥🎉
- Improved security of session cookies in the administration area.
- (on the server) Changed X-Frame-Options response header from SAMEORIGIN to DENY.

## [1.10.0] - 2018-08-15
### Added
- Added the possibility to request the deletion of a partner in the administration area.
- Added an announcement on the home page regarding the withdrawal of the first series of bills, as well as a dedicated page providing additional information.

## [1.9.0] - 2018-07-05
### Added
- Added a backup system.
- Added a custom view for when the website is in maintenance mode.

### Changed
- New partners are now automatically assigned to the team of the member who created them.

## [1.8.0] - 2018-06-25
### Changed
- The ‘Under construction’ message in the site footer has been replaced by a menu of links duplicating the one in the site header.

## [1.7.0] - 2018-06-25
### Added
- Each partner has a page displaying its information/details.

### Changed
- Updated content in the page for ‘apéros’.

## [1.6.0] - 2018-06-08
### Added
- Breadcrumbs navigation system inside administration area.
- New index page for the management of partners.
- Partners are now linked to teams.
- Websites can now be assigned to partners.

### Changed
- Updated content in the page for ‘apéros’.

## [1.5.0] - 2018-04-18
### Added
- Added some foundations for the management of volunteers. Still a work in progress.

### Changed
- The application has been upgraded to Laravel 5.6.
- Updated content in the page for ‘apéros’.

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

[1.16.0]: https://github.com/monnaie-valheureux/radisse/compare/v1.15.0...v1.16.0
[1.15.0]: https://github.com/monnaie-valheureux/radisse/compare/v1.14.0...1.15.0
[1.14.0]: https://github.com/monnaie-valheureux/radisse/compare/v1.13.0...1.14.0
[1.13.0]: https://github.com/monnaie-valheureux/radisse/compare/v1.12.0...1.13.0
[1.12.0]: https://github.com/monnaie-valheureux/radisse/compare/v1.11.0...v1.12.0
[1.11.0]: https://github.com/monnaie-valheureux/radisse/compare/v1.10.0...v1.11.0
[1.10.0]: https://github.com/monnaie-valheureux/radisse/compare/v1.9.0...v1.10.0
[1.9.0]: https://github.com/monnaie-valheureux/radisse/compare/v1.8.0...v1.9.0
[1.8.0]: https://github.com/monnaie-valheureux/radisse/compare/v1.7.0...v1.8.0
[1.7.0]: https://github.com/monnaie-valheureux/radisse/compare/v1.6.0...v1.7.0
[1.6.0]: https://github.com/monnaie-valheureux/radisse/compare/v1.5.0...v1.6.0
[1.5.0]: https://github.com/monnaie-valheureux/radisse/compare/v1.4.0...v1.5.0
[1.4.0]: https://github.com/monnaie-valheureux/radisse/compare/v1.3.0...v1.4.0
[1.3.0]: https://github.com/monnaie-valheureux/radisse/compare/v1.2.0...v1.3.0
[1.2.0]: https://github.com/monnaie-valheureux/radisse/compare/v1.1.0...v1.2.0
[1.1.0]: https://github.com/monnaie-valheureux/radisse/compare/v1.0.0...v1.1.0
