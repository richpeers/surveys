# Surveys
[![License: GPL v3](https://img.shields.io/badge/License-GPL%20v3-blue.svg)](https://www.gnu.org/licenses/gpl-3.0)

Create a survey and embed in your website. [Live Demo](http://surveys.richpeers.co.uk/) is master branch

Uses [Laravel](https://laravel.com/), [VueJS](https://vuejs.org/), [Vuex](https://vuex.vuejs.org/), [Vue.Draggable](https://github.com/SortableJS/Vue.Draggable) [Bulma](http://bulma.io/)

## Roadmap
- ~~Map out database in an ERD~~
- ~~Auth~~
- ~~Tests and backend for creating a new survey~~
- ~~Refactor vuejs to use vuex for shared state~~
- ~~Tests and backend for saving a new survey~~
- ~~Frontend for creating a new survey~~
- ~~Frontend for saving a new survey~~
- ~~Validation tests / server side for new survey~~
- ~~Client side validation for new survey~~
- ~~List user surveys tests / backend / frontend~~
- ~~Edit survey  tests / backend / frontend~~
- ~~Update suvey tests / backend / frontend~~

- refactor - inserts for performance / extract out of controllers
- refactor - DRY vue / vuex -> modules, pull client side validation into top level component for style / options tabs

- API for completing survey via embedded script on client site - tests / backend
- Frontend script for embedded widget
- lock a survey to domain(s)
- live preview for desktop + preview button for mobile
- mobile only - remove drag/drop and replace with dropdown
- publish a survey
- enable downloading of results
- UI for customising appearance of embedded widget
- scheduled clean up script for soft-deleted questions / options that don't already have answers submitted

- logic / branching (if this option chosen, proceed to x) ?
- laravel dusk ?
- SaaS ?
