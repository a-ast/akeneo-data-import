# TODO

## All

1. Test both ways of product update - direct API and via rabbitMQ
1. Implement fake data generator.

## Akeneo Import Tool

1.

## Akeneo Import

1. Implement own simple command bus.
1. Create bundle?
    1. With the consume command that shows proper progress and statuses (requeue etc)
1. Important: journal/log/report for failed requests in consumer (in order to monitor what happened in MQ).


## Import Commands

1. Implement limitations of type in a command list and overall limit
1. Test with product models
1. Implement uploading images



## Akeneo Api Command Handler

1. Add uploading images using ($this->client->getProductMediaFileApi())

