<?php

namespace App\Attachment;

class CategoryAttachment extends Attachment
{
    protected string $path = UPLOAD_PATH . DIRECTORY_SEPARATOR . "categories";
    protected array $formats = ['small'];
}