<?php

namespace Milestone\SS\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('ePlusAccountGroup',function(Builder $builder){
            $builder->orderBy('date','desc');
        });
    }

    protected $table = 'transactions';

    public function Details(){ return $this->hasMany(TransactionDetail::class,'transaction','id')->with(['Product']); }
    public function Products(){ return $this->belongsToMany(StoreProductTransaction::class,'transaction_details','transaction','spt')->withPivot(['amount','rate','tax','discount'])->with(['Product'])->withTimestamps(); }

    public function scopeAssignedCustomerTransactions($Q){
        return $Q->whereIn('customer',User::find(request()->user()->id)->AreaCustomers->pluck('user')->all());
    }
}
