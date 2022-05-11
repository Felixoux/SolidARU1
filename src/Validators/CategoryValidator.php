<?php

namespace App\Validators;

use App\Table\CategoryTable;

class CategoryValidator extends AbstractValidator
{
    public function __construct(array $data, CategoryTable $table, ?int $id = null)
    {
        parent::__construct($data);
        $this->validator::lang('fr');
        $this->validator->setPrependLabels(false);
        $this->validator->rule('required', ['name', 'slug']);
        $this->validator->rule('lengthBetween', ['name', 'slug'], 3, 200);
        $this->validator->rule('slug', 'slug');
        $this->validator->rule('image', 'image');
        $this->validator->rule(function ($field, $value) use ($table, $id) {
            return !$table->exists($field, $value, $id);
        }, ['slug', 'name'], 'Cette valeur est déjà utilisé');
    }
}