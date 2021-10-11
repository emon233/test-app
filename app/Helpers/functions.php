<?php

function upload_files($file, $file_name, $disk = 'local')
{
    $path = $file->storeAs($disk, $file_name);

    return $path;
}


