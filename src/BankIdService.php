<?php
/**
 * Created by PhpStorm.
 * User: Oleksii
 * Date: 26/02/2019
 * Time: 09:41
 */

namespace BankId;


use BankId\Exceptions\ValidationException;
use GuzzleHttp\Client;

class BankIdService
{
    protected $api_url;
    protected $server_ip;
    protected $Client;

    public function __construct(string $api_url, string $server_ip, array $client_options)
    {
        // Validate url
        if (filter_var($api_url, FILTER_VALIDATE_URL)) {
            $this->api_url = $api_url;
        } else {
            throw new ValidationException("url '$api_url' is not a valid");
        }

        //Validate ip
        if (filter_var($server_ip, FILTER_VALIDATE_IP)) {
            $this->$server_ip = $server_ip;
        } else {
            throw new ValidationException("url '$server_ip' is not a valid");
        }

        $client_options['base_uri'] = $this->api_url;
        $client_options['json'] = true;

        $this->Client = new Client($client_options);
    }
}