<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;

class MultilingualFieldsObserver
{
    public function saving(Model $model): void
    {
        if (!method_exists($model, 'getMultilingualFields')) {
            return;
        }

        foreach ($model::getMultilingualFields() as $field) {
            if (!isset($model->$field)) {
                continue;
            }

            $original = $model->getOriginal($field) ?? [];
            $updated = $model->$field;

            foreach ($updated as $lang => $value) {
                $original[$lang] = $value;
            }

            $model->$field = $original;
        }
    }}
