<?php
namespace PRIME\Authenticators;
use PRIME\Authenticators\Oauth2AuthenticatorBase as Oauth2AuthenticatorBase;
use PRIME\Models\DataConnector;

class VkontakteController extends Oauth2AuthenticatorBase
{
    
    public function initialize()
    {
        $this->form_struct ='{"auth":
        [
        {"name":"client_id","label":"Client ID","type":"input" },
        {"name":"client_secret","label":"Client Secret","type":"input"}
        ]
        }';

        $this->provider_name="\J4k\OAuth2\Client\Provider\Vkontakte";
    }

}
