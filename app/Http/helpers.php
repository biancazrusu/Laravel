<?php

function getWebsiteId()
{
    foreach (\App\Models\Website::all() as $website) {
        if (URL::to('/') == $website->url) {
            return $website->id;
        }
    }
}
