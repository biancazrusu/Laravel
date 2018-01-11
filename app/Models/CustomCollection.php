<?php

namespace App\Models;

use Illuminate\Support\Facades\App;

class CustomCollection extends \Illuminate\Database\Eloquent\Collection
{
    protected $websiteId = 1;

    public function __construct(array $attributes = array())
    {
        if (getWebsiteId()) {
            $this->websiteId = getWebsiteId();
        }

        return parent::__construct($attributes);
    }

    public function filterByWebsite($strict = true)
    {
        return $this->filter(function ($item) use ($strict) {
            return $strict ? data_get($item, 'website_id') === $this->websiteId
            : data_get($item, 'website_id') == $this->websiteId;
        });
    }
}
