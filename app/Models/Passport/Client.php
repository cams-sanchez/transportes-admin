<?php

namespace App\Models\Passport;

use App\Traits\DefaultModelPropertiesChanger;
use Laravel\Passport\Client as OAuthClient;

class Client extends OAuthClient
{
    use DefaultModelPropertiesChanger;
}
