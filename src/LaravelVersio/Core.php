<?php

namespace LaravelVersio;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Core
{
    /*
     * Public
     */
    public $total;
    public $success;

    /*
     * Private
     */
    private $guzzle;

    /*
     * Protected
     */
    protected $command;
    protected $options;

    public function __construct()
    {
        $this->guzzle = new Client();
    }

    public function send()
    {
        $options = [
            'klantId' => env('VERSIO_ID'),
            'klantPw' => env('VERSIO_PASS'),
            'sandBox' => false,
            'command' => $this->command
        ];

        if($this->options){
            foreach($this->options as $key => $option){
                $options[$key] = $option;
            }
        }

        $r = $this->guzzle->post('https://www.secure.versio.nl/api/api_server.php', [
            'form_params' => $options
        ]);

        $response = $this->ParseResponse($r->getBody()->getContents());

        if(!$response['success']){
            throw new \Exception($response['command_response_message']);
        }

        $response = collect($response);

        $this->success = $response->pull('success');
        $this->total = $response->pull('total_count');

        return $response;
    }

    function ParseResponse($buffer)
    {
        $values = [];

        // Parse the string into lines
        $lines = explode("\n", $buffer);
        $amount_lines = count($lines);

        // Parse lines
        for ($i = 0; $i < $amount_lines; $i++) {

            // It is not, parse it
            $result = explode("=", $lines[$i], 2);

            // Make sure we got 2 strings
            if (count($result) >= 2) {

                // Trim whitespace and add values
                $name = trim($result[0]);
                $value = trim($result[1]);
                $values[$name] = $value;
            }
        }

        return $values;
    }
}