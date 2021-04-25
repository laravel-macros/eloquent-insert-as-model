<?php

namespace LaravelMacros\Eloquent;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class InsertAsModelServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Since $attributes in Model is protected,
        // we will use this workaround.
        $getRawAttributeFromModel = function (Model $model, $key) {
            return Closure::bind(
                function ($key) {
                    /** @var Model $this */
                    return $this->attributes[$key];
                },
                $model,
                $model,
            )($key);
        };

        Builder::macro('insertAsModel', function (array $values) use ($getRawAttributeFromModel) {
            // The conditions here for handling $values parameter cases,
            // are copied from the 'insert' method body.
            if (empty($values)) {
                return true;
            }

            if (! is_array(reset($values))) {
                $values = [$values];
            }

            /** @var Builder $this */
            return $this->insert(
                collect($values)
                ->map(function ($attributes) use ($getRawAttributeFromModel) {
                    foreach ($attributes as $key => $value) {
                        /** @var Builder $this */
                        $model = $this->getModel();
                        $model->setAttribute($key, $value);

                        $attributes[$key] = $getRawAttributeFromModel($model, $key);
                    }

                    return $attributes;
                })
                ->toArray()
            );
        });

        Builder::macro('insertAsModels', function (array $values) {
            /** @var Builder $this */
            return $this->insertAsModel($values);
        });
    }
}
