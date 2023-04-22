# Laravel & PHP back end project

Welcome to another one of my API projects. For this one, I decided to go with Laravel and took advantage of its user authentication and authorisation features, as well as its integration testing capabilites to fully test the API's features.

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Key product features
- Expressive Laravel-specific syntax with extensive method-chaining, allowing for more concise code structure.
- Developed in a test-driven manner using PHPUnit and Laravel's fluent JSON syntax (based on closures and the AssertableJson class).
- Architected using an object-oriented MVC pattern
- Authentication services implemented using Sanctum
    - Users are able to sign up and log in.
    - Protected routes are only accessible to users with valid API tokens.
- Authorization services implemented using Laravel's gates, a closure-based approach to authorization.
    - Certain actions are only permitted to users with specific roles, such as admin status.
- Relationships and schema constraints defined using Eloquent ORM's relationships tools
