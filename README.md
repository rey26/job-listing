# About #

- download job listings from Recruitis API
- cache results from external API
- view and paginate jobs in simple UI

## Installation ##

1. install dependencies ``composer install``
1. run tests ``php bin/phpunit``
1. start webserver ``symfony server:start -d``

## TODO ##

- implement missing properties for the Job entity (secured_id, access_state, stats, fte, filterlist, detail, addresses)
- use enums from API (e.g. Salary unit, Salary currency)
- add unit tests for all entities
- add more integration tests
