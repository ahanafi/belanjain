<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

function formatPrice($value)
{
    return 'Rp ' . number_format($value, 0, ',', '.');
}

function authUser()
{
    return Auth::user();
}

function indonesianDate($date)
{
    return Carbon::parse($date)->isoFormat('LL');
}

function getAge($date)
{
    $birth_date = Carbon::parse($date);
    $now = Carbon::now();

    return $birth_date->diffInYears($now);
}

function getGender($gender)
{
    return $gender == 'lake' ? 'Laki-Laki' : 'Perempuan';
}

function getStatus($status)
{
    return $status == 1 ? '<span class="badge badge-primary">Aktif</span>' : '<span class="badge badge-secondary">Nonaktif</span>';
}

function uploadFile($base_64_foto, $folder)
{
    try {
        $foto = base64_decode($base_64_foto['data']);
        $folderName = 'images/' . $folder;

        if (!file_exists($folderName)) {
            mkdir($folderName, 0755, true);
        }

        $safeName = time() . $base_64_foto['name'];
        $newPath = public_path() . '/' . $folderName;
        file_put_contents($newPath . '/' . $safeName, $foto);

    } catch (Exception $e) {
        Log::info($e->getMessage());
        return 0;
    }

    return $folder . '/' . $safeName;
}

function isActive($param)
{
    return request()->route()->getPrefix() === '/' . $param ? 'active' : '';
}

function showFor($roles)
{
    foreach ($roles as $role) {
        if (userRole() == $role) {
            return true;
        }
    }

    return false;
}

if (!function_exists('setFlashMessage')) {
    function setFlashMessage($type, $actionType, $dataType)
    {
        $messageType = "";
        $messageStatus = ($type === 'success') ? " berhasil " : " gagal ";

        if (in_array($actionType, ['insert', 'add'])) {
            $messageType = " disimpan!";
        } else if (in_array($actionType, ['update', 'edit'])) {
            $messageType = " diperbarui!";
        } else if (in_array($actionType, ['delete', 'destroy', 'remove'])) {
            $messageType = " dihapus!";
        } else if ($actionType === 'upload') {
            $messageType = " diupload!";
        }

        $messageText = "Data " . $dataType . $messageStatus . $messageType;

        //For customize message
        if ($actionType === 'custom') {
            $messageText = $dataType;
        }

        return [
            'type' => $type,
            'text' => $messageText,
        ];
    }
}

if(!function_exists('removeDecimal')) {
    function removeDecimal($number) {
        $number = explode(".", $number);
        return $number[0];
    }
}
