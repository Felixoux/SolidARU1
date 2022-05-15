<?php

namespace App\Validators;

use App\Table\PostTable;

class PostValidator extends AbstractValidator
{
    public function __construct(array $data, PostTable $table, ?int $postID = null, array $categories, array $images, array $files)
    {
        parent::__construct($data);
        $this->validator::lang('fr');
        $this->validator->setPrependLabels(false);
        $this->validator->rule('required', ['name', 'slug', 'content']);
        $this->validator->rule('lengthBetween', ['name', 'slug'], 5, 50);
        $this->validator->rule('lengthBetween', ['content'], 10, 10000);
        $this->validator->rule('slug', 'slug');
        $this->validator->rule('subset', 'categories_ids', array_keys($categories));
        $this->validator->rule('subset', 'images_ids', array_keys($images));
        $this->validator->rule('subset', 'files_ids', array_keys($files));
        $this->validator->rule('image', 'image');
        $this->validator->rule('date', 'created_at');
        $this->validator->rule(function ($field, $value) use ($table, $postID) {
            return !$table->exists($field, $value, $postID);
        }, ['slug', 'name'], 'Cette valeur est déjà utilisé');
    }
}