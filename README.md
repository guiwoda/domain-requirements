# DomainRequirements

This package aims to provide a simple and semantic way of decoupling your presentation needs from your domain objects.

## The problem

As we build websites, we often start up with straightforward pages that reflect our data structure.
The `Controllers` we build usually depend on some `Repository` or adapter `Service` that works as a data abstraction.
As the system grows tho, this `Controllers` start depending on multiple of this objects, and the role of the `Controller`
ends up as a huge coordinator of different parts of our Domain Model.

We recognize this as a problem immediately, and move this logic to our `Domain` layer.
This creates a different architecture, where any new data needed by the presentation layer requires changes in our
coordination objects inside our `Domain`, which is a long way to say we have coupled our `Domain` to our presentation
needs!

## The proposed solution

The connection between `Controllers` and the `Domain` is usually done through encapsulation. The dependency arrows
always point **to** the `Domain`. But there are *implicit* dependencies that are pointing outwards **from** the `Domain`,
and that is what this package aims to change.

Each controller would create a (set of) `Requirement` object(s). This `Requirements` are plain POJOs that will work as
`Data Transfer Objects` between our presentation layer and the domain. In this objects, the `Controller` will list all
its `Domain` dependencies, and will include also all associated parameters that will be needed to resolve this dependencies.

`Requirement` objects will be sent to a `Responsible` object to be resolved. This `Responsibles` should be associated
beforehand in an identity map fashion, indicating what `Domain need` they promise to resolve.
A `CallbackResponsible` implementation is provided as an easy way to start using this pattern without changing any of your
objects' interface. If a callback is not enough, any object can implement `Responsible` and respond to a `Requirement`.

## TL;DR

Use `Requirements` to list what you expect from the `Domain`. Use `Responsibles` to respond to those needs.
Oh, and **always program to an interface!**




