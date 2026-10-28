<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'full_name', 'brand_name', 'role', 'headline', 'tagline', 'about', 'availability',
    'years_experience', 'projects_count', 'clients_count', 'email', 'phone', 'location',
    'whatsapp_url', 'github_url', 'linkedin_url', 'website_url', 'meta_description',
])]
class SiteSetting extends Model
{
    public static function current(): self
    {
        return static::query()->firstOrCreate(['id' => 1], [
            'full_name' => 'Felix Nelsony',
            'brand_name' => 'Lyxweb Technologies',
            'role' => 'Lead Software Engineer & Architect',
            'headline' => 'Crafting modern web & mobile experiences.',
            'tagline' => 'Digital products, built with purpose.',
            'about' => 'I build fast, dependable digital products for ambitious businesses and teams.',
            'availability' => 'Available for projects',
            'years_experience' => 5,
            'projects_count' => 50,
            'clients_count' => 30,
            'email' => 'info@lyxweb.co.tz',
            'phone' => '+255 757 585 640',
            'location' => 'Tanzania',
            'website_url' => 'https://lyxweb.co.tz',
            'meta_description' => 'Felix Nelsony builds high-performance web applications and digital products in Tanzania.',
        ]);
    }
}
