# Changelog
All notable changes to this project will be documented in this file.

## 0.6 - Unreleased (Federsee)
This version is a complete rewrite using Laravel and Vue.js. Please refer to the [INSTALL.md](INSTALL.md) for migration and new setup information.

### Changed
- Moved from Lumen (5.3) to Laravel (5.7)
- Moved from AngularJS (1.5) to Vue.js (2.5)
- Updated Bootstrap 3.3 to 4.1
- Switched from Material Design back to original Bootstrap
- Switched from Material Icons to new FontAwesome 5.5
- User/Role Management bundle several actions (Save, Edit, Delete, ...) in single dropdown (...-menu)
- Tree View now loads root elements only. Sub-elements are loaded on request

## 0.5 - Ephesus

Version bump to 0.5 to match Spacialist's current release

### Added
- User Management (same as in Spacialist)
- Toggle Button to show/hide sandbox tree

### Changed
- Switch tables for project and sandbox tree
- Replaced vanilla bootstrap with Material Design

### Fixed
- Hide elements if user has insufficient permissions
- RDF import
- Tree unfolding
- Language Switcher in modals
- Several UI fixes

## 0.1 - Atlantis

First working version

### Added
- Thesaurus Tree (for master and project thesaurus)
- Concept Editor (SKOS preferred and alternative labels, SKOS narrower and broader concepts)
- SKOS RDF Import/Export