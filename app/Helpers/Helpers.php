<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

function formatPrice($value){
    return 'Rp '. number_format($value,0,',','.');
}

function userRole($level = null){
    $role_name = ($level ?? Auth::user()->level) == User::$admin ? 'admin' : (($level ?? Auth::user()->level) == User::$kades ? 'kades' : 'staff');

    return $role_name;
}


function authUser(){
    return Auth::user();
}

function indonesianDate($date){
    return Carbon::parse($date)->isoFormat('LL');
}

function getAge($date){
    $birth_date = Carbon::parse($date);
    $now = Carbon::now();

    return $birth_date->diffInYears($now);
}

function getGender($gender){
    return $gender == 'lake' ? 'Laki-Laki' : 'Perempuan';
}

function getStatus($status){
    return $status == 1 ? '<span class="badge badge-primary">Aktif</span>' : '<span class="badge badge-secondary">Nonaktif</span>';
}

function uploadFile($base_64_foto, $folder){
    try {
        $foto = base64_decode($base_64_foto['data']);
        $folderName = 'images/'.$folder;
        
        if (!file_exists($folderName)) {
            mkdir($folderName, 0755, true); 
        }

        $safeName = time() . $base_64_foto['name'];
        $newPath = public_path() . '/' . $folderName;
        file_put_contents($newPath. '/' . $safeName, $foto);

    } catch (Exception $e) {
        Log::info($e->getMessage());
        return 0;
    }

    return $folder.'/'.$safeName;
}

function isActive($param){
    return Request::route()->getPrefix() == '/'.$param ? 'active' : '';
}

function showFor($roles)
{
    foreach($roles as $role){
        if(userRole() == $role){
            return true;
        }
    }

    return false;
}