<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class home extends Model
{
    use HasFactory;
    
    protected $table = 'home_page_contents';
    
    protected $fillable = [
        'section_key',
        'section_name',
        'content',
        'image_path',
        'media_type',
        'media_url',
        'youtube_api_key',
        'youtube_channel_id',
        'max_youtube_results',
        'sort_order',
        'is_active',
    ];
    
    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'max_youtube_results' => 'integer',
    ];
    
    /**
     * Get content by section key
     */
    public static function getByKey($key, $default = null)
    {
        $content = self::where('section_key', $key)->where('is_active', true)->first();
        return $content ? $content->content : $default;
    }
    
    /**
     * Get image path by section key
     */
    public static function getImageByKey($key, $default = null)
    {
        $content = self::where('section_key', $key)->where('is_active', true)->first();
        return $content && $content->image_path ? $content->image_path : $default;
    }
    
    /**
     * Get YouTube settings
     */
    public static function getYouTubeSettings()
    {
        $settings = self::where('section_key', 'youtube_settings')->first();
        return [
            'api_key' => $settings->youtube_api_key ?? null,
            'channel_id' => $settings->youtube_channel_id ?? null,
            'max_results' => $settings->max_youtube_results ?? 6,
        ];
    }
    
    /**
     * Get hero media settings
     */
    public static function getHeroMedia()
    {
        $media = self::where('section_key', 'hero_media')->where('is_active', true)->first();
        if ($media) {
            return [
                'type' => $media->media_type ?? null,
                'url' => $media->media_url ?? null,
            ];
        }
        return null;
    }
    
    /**
     * Get organization name
     */
    public static function getOrganizationName($default = 'BAN-PDM')
    {
        $orgName = self::where('section_key', 'organization_name')->where('is_active', true)->first();
        return $orgName && $orgName->content ? trim($orgName->content) : $default;
    }
}
