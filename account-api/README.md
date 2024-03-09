# Account events API

### Build and run

```shell
curl -L -O https://github.com/milinsky/account-event-api/archive/refs/heads/main.zip
```
```shell
unzip main.zip -d account-event-api
```
```shell
cd account-event-api
```
```shell
make build
```
```shell
make up
```

### Api usage

```POST http://localhost/api/account-event```
```
{
    "account_id": 1,
    "event_id": 1
}

```

RabbitMQ dashboard http://localhost:15672
