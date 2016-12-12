# MultipleInheritBundle

[@php]:             http://php.net/                         "PHP: Hypertext Preprocessor"
[@symfony]:         http://www.symfony.com/                 "High Performance PHP Framework for Web Development"


This is a fork of FranckRanaivo/MultipleInheritBundle and aims to port this bundle to symfony 3.

This bundle aims to provide the missing Symfony 2 functionality, when multiple child bundles inherits from one parent.
As an example, here is the task of building sites-satellites, when you have the main site,
and sites hosted on subdomains, in which need to be changed some templates and/or part of the logic in the controllers.

## Requirements
* [PHP][@php] 5.3.3 and up
* [Symfony][@symfony] 2.2 or higher

## Installing and configuring

