<?php

namespace App\Attachment;

class CategoryAttachment extends Attachment
{
    protected $path = UPLOAD_PATH . DIRECTORY_SEPARATOR . "categories";
}