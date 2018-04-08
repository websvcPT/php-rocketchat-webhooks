# php-rocketchat-webhooks
Send notifications to existing Rocket Chat Webhooks

Tested with Rocket Chat server  v 0.63.0

## Install


## Rocket Chat setup

Create a new Incomming Hook in Administration and retrieve the URL with token.


## Usage

Simple message: 
```php

$client = new \PhpRocketChatWebhooks\Client('https://rocket.chat/hooks/TOKEN', "Optiona-Username");
$client->sendRequest("Hello World!");
```

Message with attachment:
```php
$client = new \PhpRocketChatWebhooks\Client('https://rocket.chat/hooks/TOKEN', "Optiona-Username");
$client->sendRequest("Hello World!", [
                    'title' => "Google homepage",
                    'title_link' => "https://google.com",
                    'text' => "text text text text text text text",
                    'image_url' => "https://www.google.pt/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png",
                ]);
```
