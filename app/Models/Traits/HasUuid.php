<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

trait HasUuid {
    protected static function boot(){
        parent::boot();

        static::creating(function(self $log){
            $log->uuid = $log->uuid ?? (string) Str::uuid();
        });

        static::updating(function(self $log){
            if($log->isDirty()){
                $log->uuid = $log->getOriginal('uuid');
            }
        });

    }
}

