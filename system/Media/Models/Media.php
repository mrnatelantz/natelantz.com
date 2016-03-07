<?php

namespace RadCms\Media\Models;

use Illuminate\Database\Eloquent\Model;
use SahusoftCom\EloquentImageMutator\EloquentImageMutatorTrait;

class Media extends Model
{

    use EloquentImageMutatorTrait;

    protected $fillable = ['name', 'description', 'type', 'item', 'folder'];

    protected $image_fields = ['item'];
}