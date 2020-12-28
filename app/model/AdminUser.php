<?php


namespace app\model;


class AdminUser extends BaseModel
{
    public $incrementing = false;

    public $table = 'admin_user';

    protected $fillable = [
        'id',
        'name',
        'account',
        'password'
    ];
}