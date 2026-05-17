<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Admin\access;

class adminPage extends Model
{
  protected $table = 'admin_page';
  
  protected $fillable = [
    'pageName',
    'status',
    'uuid',
  ];
  
  
  public function access()
    {
        return $this->hasMany(access::class, 'pagename', 'pageName');
    }
  
  
}
