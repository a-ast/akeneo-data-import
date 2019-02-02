# TODO

## New II generation


New Classes


Command Provider -> Publisher (amqp/in memory) -> Consumer() -> Importer(form Queue)


Sync mode

SyncApiImporter supports internal in-memory queue 
for command republishing (InMemoryPublisher / InMemoryQueue / InMemoryConsumer or QueueReader).
Can be implemented as a decorator for AsyncApiImporter.

AsyncApiImporter doesn't support any queueing mechanism.
Reads, accumulates and sends commands to Akeneo API.

```
$importer = (new ApiImporterFactory())->createByCredentials(...api credentials);
$importer->import($commands);
```

Async mode

Publisher
AmqpPublisher publishes commands to MQ.

```
$publisher = new AmqpPublisher(...dsn)
$publisher->publish($commands);
```

Consumer

AmqpConsumer reads commands from MQ. 

```
$queue = new AmqpQueue(...dsn);

$importer = new AmqpApiImporter(...api credentials);
$importer->import($queue);
```


Problem

1. Generic command accumulation (e.g. for FileGenerator) - 
   or just ignore it assuming that for huge volumes one should use MQ/API?
2. FinishImport flag for golang consumer.



??? how to connect to Importer?



1. CommandBus that allows broadcating FinishImport
1. WOOOOOOW: how to Implement sync mode in Upsertable????
    Solution: one adaper for all upserables with accumulators (batches) for every command class
1. Accumulation of commands

1. Rework Amqp (or async handler)


## Important
1. Integration tests - behat?
1. Install Php cs
1. With own bus: generate import id and pass it to handlers, identify every batch (command list) for logging, recovering
1. Remove all @todos
1. Test both ways of product update - direct API and via rabbitMQ, test failure scenarios
    1.1 Implement processing media via MQ
1. Implement fake data generator.
1. Install supervisord and test with 1M products (run on DO?)

## Akeneo Import Tool

1.

## Akeneo Import
1. Implement own simple command bus (pros/cons analysis).
1. Create bundle?
    1. With the consume command that shows proper progress and statuses (requeue etc)
1. Important: journal/log/report for failed requests in consumer (in order to monitor what happened in MQ).
1. Test all relations parent/child in order to use it with MQ.
1. Implement creating media using MQ.

## Import Commands

1. Implement limitations of type in a command list and overall limit
1. ProductModel delete command.
1. CreateOrUpdateAttribute
1. CreateOrUpdateAttributeOption


## Akeneo Api Command Handler

1. (!) Extensive logging of failed requests (with import id)


## What needs to be done for real use / for demo

1. Logging
2. Testing on DO: akeneo / rabbit mq / import tool  
