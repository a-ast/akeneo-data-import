# Akeneo Data Import (in progress)

Application for data import to Akeneo PIM.

Set of tools that allow to import data asynchronously using RabbitMQ or synchronously with Akeneo API. 

Use cases

Import from external systems (legacy PIM or regular data provider). 
Import from old versions (replacement for Trasporteo).
Data generation (for testing, local development, performance benchmarking).
Media file import. 
Batch data manipulations (e.g. if Akeneo code is not allowed to be modified / Serenity edition).

## Package diagram

![Packages](docs/packages.png)


## Architecture

![Packages](docs/hexagonal.png)
