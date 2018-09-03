<?php

    class CommonService
    {
        private static $instance;

        public static function get_instance()
        {
            if (NULL === static::$instance) {
                static::$instance = new static();
            }

            return static::$instance;
        }
    }