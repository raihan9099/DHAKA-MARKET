# Dhaka Market site (platform-agnostic)

A PHP-based CMS site with a frontend package (“theme”) and an extension module for address normalization. This repo is structured for clean version control and CI/CD without committing runtime files or secrets.

## Goals
- Track only source: frontend package and custom modules.
- Exclude runtime: uploads, core, vendor, caches, secrets, DB dumps.
- Support bilingual (bn_BD/en_US), logistics fields, and automated deploys.

## Structure
