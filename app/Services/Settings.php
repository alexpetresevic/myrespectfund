<?php

namespace App\Services;

use App\Settings as Model;

class Settings
{
    protected static $instance = null;

    private function __construct() {}

    public static function getInstance()
    {
        if (! self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function get($key, $default = null)
    {
        if ($this->has($key)) {
            return Model::where('key', $key)->first()->value;
        }

        return $default;
    }

    public function set($key, $value)
    {
        if ($this->has($key)) {
            $setting        = Model::where('key', $key)->first();
            $setting->value = $value;
        } else {
            $setting        = new Model();
            $setting->key   = $key;
            $setting->value = $value;
        }

        return $setting->save();
    }

    public function has($key)
    {
        return Model::where('key', $key)->exists();
    }
}
