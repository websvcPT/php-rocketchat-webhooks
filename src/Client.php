<?php

namespace PhpRocketChatWebhooks;

class Client {

    /**
     * @var string The to send the request to.
     */
    private $url;

    /**
     * @var string The message to send to rocketchat incomming webhook.
     */
    public $message;

    /**
     * Client constructor.
     * @param string $url
     * @param string $username
     */
    public function __construct($url, $username=null){
        $this->url = $url;
        $this->username = $username;
    }

    /**
     * Sends a payload to the server.
     * @param array $payload
     */
    public function sendRequest($message, $attachment=false){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_VERBOSE,0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->buildJsonPayload($message, $attachment));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'User-Agent: websvc-php-rocketchat-webhook',
            'Content-Type: application/json',
        ));
		curl_setopt($ch, CURLOPT_HEADER, true);

        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		if($httpcode == 200 ){
			return true;
		}

		return false;

    }

    /**
     * Builds JSON Payload.
     * @return string
     */
    private function buildJsonPayload($message, $attachment=false){

        $json = [
            'username' => $this->username,
            'text' => $message
        ];

        if($attachment){
            $json['attachments'] = [
                [
                'title' => (isset($attachment['title'])?$attachment['title']:null),
                'title_link' => (isset($attachment['title_link'])?$attachment['title_link']:null),
                'text' => (isset($attachment['text'])?$attachment['text']:null),
                'image_url' => (isset($attachment['image_url'])?$attachment['image_url']:null),
                'color' => '#764FA5',
                ],
            ];
        }

        return json_encode($json);
    }
}
