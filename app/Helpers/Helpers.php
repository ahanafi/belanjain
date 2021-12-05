<?php
if (!function_exists('isActive')) {
    function isActive($param)
    {
        return request()->route()->getPrefix() === '/' . $param ? 'active' : '';
    }
}

if (!function_exists('setFlashMessage')) {
    function setFlashMessage($type, $actionType, $dataType)
    {
        $messageType = "";
        $messageStatus = ($type === 'success') ? " berhasil " : " gagal ";

        if (in_array($actionType, ['insert', 'create', 'add'])) {
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

if (!function_exists('removeDecimal')) {
    function removeDecimal($number)
    {
        $number = explode(".", $number);
        return $number[0];
    }
}
