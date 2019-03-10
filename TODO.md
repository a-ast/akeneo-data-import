# TODO

## Important
1. Test both ways of product update - direct API and via rabbitMQ, test failure scenarios
    1.1 Implement processing media via MQ
1. Install Php cs
1. With own bus: generate import id and pass it to handlers, identify every batch (command list) for logging, recovering
1. Remove all @todos
1. Implement fake data generator.
1. Install supervisord and test with 1M products (run on DO?)
1. Progress of import

## Akeneo Import Tool

1.

## Akeneo Import
1. Create bundle
    1. With the consume command that shows proper progress and statuses (requeue etc)
1. Important: journal/log/report for failed requests in consumer (in order to monitor what happened in MQ).
1. Test all relations parent/child in order to use it with MQ.
1. Implement creating media using MQ.

## Import Commands

1. Attribute
1. AttributeOption


## What needs to be done for real use / for demo

1. Logging
2. Testing on DO: akeneo / rabbit mq / import tool  
