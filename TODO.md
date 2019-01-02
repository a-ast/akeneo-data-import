# TODO

## All
Task 1: move normalizers to commands (improve namespaces there)
Create HandlerBuilder in handler with created serializer (to avoid global config for that)

1. Test both ways od product update - direct API and via rabbitMQ
1. Implement fake data generator.

## Akeneo Import Tool

1. Implement selecting data provider
1. Implement own simple command bus.

## Akeneo Import

1. Impement selecting queue in  consumer/receiver
1. Move all messenger-related classes to Messenger endpoint.
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
