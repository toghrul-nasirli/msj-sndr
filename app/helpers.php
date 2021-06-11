<?php

if (!function_exists('storeFile')) {
    function storeFile($storagePath, $request)
    {
        $extension = $request->getClientOriginalExtension();
        $fileNameToStore = rand(0, 10000) . '_' . time() . '.' . $extension;
        $request->storeAs('public/' . $storagePath, $fileNameToStore);

        return $fileNameToStore;
    }
}