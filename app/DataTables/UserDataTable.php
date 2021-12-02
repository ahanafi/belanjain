<?php

namespace App\DataTables;

use App\Models\User;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class UserDataTable{

    static public function set($user){
        return DataTables::of($user)
            ->editColumn('level', function($user){
                return userRole($user->level);
            })
            ->addColumn('action', function($user){
                $deleteUrl = "'".route('user.destroy', $user->id)."', 'userDatatable'";

                return  '<div class="btn-group">'.
                    '<a href="'. route('user.edit', $user->id) .'" class="btn btn-warning" >Edit</a>'.
                    '<a href="#" onclick="deleteModel('.$deleteUrl.')" class="btn btn-danger" >Hapus</a>'.
                '</div>';
            })->addIndexColumn()->rawColumns(['action'])->make(true);
    }

}
