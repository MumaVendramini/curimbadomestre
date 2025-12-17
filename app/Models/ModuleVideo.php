<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleVideo extends Model
{
    protected $table = 'module_videos';
    protected $fillable = ['module_id', 'url', 'title'];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
}
