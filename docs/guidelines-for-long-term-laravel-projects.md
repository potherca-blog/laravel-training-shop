# Guidelines for long-term Laravel projects

Although Laravel offers some wonderful features, most of the framework is geared
to getting your application of the ground faster than a speeding bullet.

This is great for experimental, small or short-term projects but it comes with
certain trade-offs. For projects that are both large, long-term and more complex,
these trade-offs can become a problem.

The problem doesn't lie with the framework, it delivers what it promises. The
problem lies with the way the framework is _used_.

To avoid certain pitfalls, rules and guidelines for working with Laravel are
needed that make it more sustainable for long-term projects

This document tries to outline such guidelines.

## In General

- Dont use facades, use dependecy injection instead
- Use YML for config, so config remains logic-free
- Don't use PHP commands in templates, make templates logic-less.
- Always use typehints in Callbacks

## Routing

- Create one controller per route, using `__invoke` as the executable method
  (rather than `index`, etc.)

## Dependcy Injection and Providers

- Register an alias for Laravel "tagged" singletons and services with a
  Class name, as these existing ones use a name (or "tag") instead of the Class
  or Interface name

## Models

- Explicitly add `protected $table = 'name_here';`
- In migrations for foreign keys, use array notation, not string (because easier)
- Place models in a separate folder (and namespace) not just `/app`

## Queues

- Don't use DB/local queues, use AMPQ (RabbitMQ, ZeroMQ, etc.) or Redis

