<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleImage extends Model
{
    protected $table = 'module_images';
    protected $fillable = ['module_id', 'file_path', 'title'];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
}
