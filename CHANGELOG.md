# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added

- Added `SignQualified` and `SignOfficiallyCertified` scopes to `Scope` enum
## [1.0.0] - 2025-11-30

### Changed

- **BREAKING**: Minimum PHP version increased to 8.2 (from 8.1)
- **BREAKING**: Upgraded web-token/jwt-framework from ^3.3 to ^4.0
- Removed deprecated `contentEncryptionAlgorithmManager` parameter from JWEBuilder

### Migration Guide

For users upgrading from v0.x:

1. Ensure your environment runs PHP >= 8.2
2. Update your composer.json to require `unnits/bankid-client: ^1.0`
3. Run `composer update`

No application code changes required - the library's API remains backwards compatible.

## [0.9.3] - 2025-11-19

### Added

- Add transactionIdentifier parameter to the Profile DTO

## [0.9.2] - 2025-06-11

### Fixed

- Fixed UserInfo claim keys to use correct underscore format (given_name, family_name, middle_name)

## [0.9.1] - 2025-07-02

### Fixed

- Fixed banks API endpoint to use the configured baseUri instead of hardcoded URL

## [0.9.0] - 2025-06-30

### Changed

- Made signature algorithm configurable in `createRequestObject` method

## [0.8.0] - 2025-02-13

### Added

- Added support for specifying nonce parameter in getAuthUri() method.

## [0.7.0] - 2024-08-09

### Added

- Added getter for clientId

## [0.6.0] - 2024-06-25

### Changed
- Update composer packages
- Regenerated PHPStan's baseline file

### Fixed
- Fixed values for backed enum `Unnits\BankId\Enums\Scope` according to Bank iD docs

## [0.5.1] - 2024-02-23

### Changed

- Updated composer dependencies and refactor JWEBuilder usage.

## [0.5.0] - 2023-12-28

### Added

- Added `private sendRequest()` method to `Client` to abstract processing HTTP responses in central palce
- Added more specific exceptions in various cases to avoid using only `Exception` class.
- Added `traceId` into error responses from Bank iD and some success responses that are also traceable
- Added information about available support by [Unnits.com](www.unnits.com)

### Changed

- Updated installation instructions.
