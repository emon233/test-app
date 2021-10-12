<?php


function get_media_types($input = null)
{
    $output = [
        MEDIA_TYPE_AUDIO => __('Audio'),
        MEDIA_TYPE_IMAGE => __('Image'),
        MEDIA_TYPE_VIDEO => __('Video')
    ];

    return isNull($input) ? $output : $output[$input];
}
