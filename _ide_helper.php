<?php

namespace Illuminate\Database\Eloquent {
    class Builder
    {
        /**
         * Similar to `insert`, but it will apply attributes casts and mutators.
         *
         * @see LaravelMacros\Eloquent\InsertAsModelServiceProvider::boot()
         * @static
         * @param  array  $values
         * @return bool
         */
        public static function insertAsModel(array $values)
        {
        }

        /**
         * Similar to `insert`, but it will apply attributes casts and mutators.
         *
         * @see LaravelMacros\Eloquent\InsertAsModelServiceProvider::boot()
         * @static
         * @param  array  $values
         * @return bool
         */
        public static function insertAsModels(array $values)
        {
        }
    }

    class Model extends Builder{}
};