# What I dislike about Laravel

Laravel offers Facades, helper functions and a service locator. This
functionality in itself is not a problem, but the fact the framework chooses to
expose this functionality _is_. Explicitly because this means developers _use_
that functionality. In my opinion we, as developers, shouldn't.

In this document, I'll try to explain _why_.

## Facades

Laravel offers Facades. Sadly, what Laravel calls "Facades" are usually merely
Proxies. This means that, instead of offering a consise subset of various API
(i.e. Facade), it is merely yet another layer between the caller code and the
callee (i.e. Proxy).

These proxies are also static class methods, which means they all live in global
scope. They are also not namespaced into separate concerns. There are over 30
Facades shipped with Laravel and more added by any number of packages.

They range from anything like Caching and Templating to Database and Logging,
and whole range of utilities besides.

Conveinient? Sure. Clean and maintainable? Not so much.

The way these proxies are exposed also violates various principles meant to make
code cleaner and more maintainable:

- [Loose coupling](https://en.wikipedia.org/wiki/Loose_coupling)
- The [dependency inversion principle](https://en.wikipedia.org/wiki/Dependency_inversion_principle)
- The [Law of Demeter](https://en.wikipedia.org/wiki/Law_of_Demeter)

To make matters worse, the framework also offers conveinience methods to help
with testing code that uses Facades. To do this, there is logic in _production_
classes for _testing_ purposes. As much as I agree with [Testivus](http://www.agitar.com/downloads/TheWayOfTestivus.pdf)
that

> "Sometimes, the test justifies the means."

I do not deem it acceptable for a _framework_ to do this. It is hiding a bigger
problem that can quite easily be solved simply by using dependency injection
rather than using Facades.

### Beyond outward appearance

To be fair, Laravel is steering its community away from facades more and more.
In its documentation, Laravel addresses the problems I have outlined.

In the "Facades" section of the manual, is has a section [explaining about
dependency-injection](https://laravel.com/docs/5.7/facades#facades-vs-dependency-injection)

Furthermore, it provides clear examples about how to avoid Facades using [contracts](https://laravel.com/docs/5.7/contracts)
(i.e. class interfaces).

Both pages live under the "Architecture Concepts" section of the manual, so that
should give you an idea that these concepts are deemed more or less basic
knowledge.

For packages the documentation even goes as far as to say:

> Most applications will be fine regardless of whether you prefer facades or
> contracts. However, if you are building a package, you should strongly
> consider using contracts since they will be easier to test in a package context.

So I guess the wait is now for the community to wisen up and catch up.

## Helper funtions

Having Factory functions in global scope is often considered an acceptable
alternative to injecting and passing around factory objects. But the helper
functions in Laravel aren't limited to factories, there are all sorts of
utility functions as well.

To complicate matters, some helpers are static class methods (`Arr`, `Str`) but
most are plain functions. None of the plain functions are proparly namespaced,
so there is no way of knowing from the outside which helpers are factories,
utilities, template functions or whatever else.

To complicate matter even further, several functions behave differently when
they have or haven't been given a parameter, acting as an executor of a method
on a class or returning an object of the class in question.

### Help yourselves

It makes sense for a framework to have utility functions and it makes sense to
use them in a framework context. Developer however, do _not have to_ use any of
these helpers.

Again, in all fairness, the documentation make note of this, stating:

> you are free to use them in your own applications if you find them convenient.

Implying you are also free to **not** use them in your own applications.

Which is exactly what I would advise developers to do. Or, at the very least,
to avoid using it in anything that is pure business logic (so only use it in the
glue layer).

## Service locator

Laravel has an `app()` function that is described as being a getter for Laravel's
[service container(https://laravel.com/docs/5.7/container) instance.

This is not a problem itself, but it violatesvvarious dependency patterns by
making it available to the business layer (rather than the glue layer).
Anywhere in the code that uses `app()`, basically pulls the entirety of the
framework into the class using it. The solution isn't to just inject the
Application object into such a class but injecting whatever is taken out of the
Application object.

In short, this means not using the container anywhere, other than to put things
**into** the container. Everywhere else should use dependency injection (which
is wired to the container by Laravel) or factories.

## Conclusion

All of these things combined promote spaghetti programming in less experienced
developers.

However, Laravel is mature enough to offer a way of working with the framework
_without_ using any of the mechanisms that offend me.

It also offers more than enough other functionality to make up for those
transgressions.

As with other frameworks, the fault does not lie with Laravel for offering these
means to clean code violations, but with the developers using and promoting them.

So lets stop using Facades, helper functions and service container and start
using dependency injection, loose coupling and a separation of concerns instead.