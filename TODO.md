# TODO

## All
Task 1: move normalizers to commands (improve namespaces there)
Create HandlerBuilder in handler with cresated serializer (to avoid global config for that)


1. Test both ways od product updaet - direct API and via rabbitMQ
1. Implement fake data generator.
1. Finish consumer - check exceptions 
1. Improve namespaces
1. Move normalizers (getData -> toArray, to to StandardFormat)

## Akeneo Import Tool

1. Implement selecting data provider
1. Implement own simple command bus.

## Akeneo Import

1. Continue simplifying config to use in symfony and non-symfony apps
    1. Think how to run it from command, how to define aliases
1. Test work without amqp
3. Move all messenger-related classes to Messenger endpoint.

1. Test reject/requeue in the MessageHandler after implementing Product models

## Import Commands

1. Implement limitations of type in a command list and overall limit
1. Implement associations
1. Implement groups
1. Test with product models
1. Implement uploading images



## Akeneo Api Command Handler

1. Add uploading images using ($this->client->getProductMediaFileApi())

## Akeneo Simplified/Fast Api Command Handler

1. Move serializer?
