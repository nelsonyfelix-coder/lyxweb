<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::query()->updateOrCreate(['id' => 1], [
            'full_name' => 'Felix Nelsony',
            'brand_name' => 'Lyxweb Technologies',
            'role' => 'Lead Software Engineer & Architect',
            'headline' => 'Crafting modern web & mobile experiences.',
            'tagline' => 'I turn complex ideas into clear, high-performing digital products.',
            'about' => 'I’m Felix Nelsony, founder and lead engineer at Lyxweb Technologies. I work with ambitious teams to design and build dependable web platforms, mobile applications, and the systems that support them. My approach pairs thoughtful product decisions with clean engineering and long-term maintainability.',
            'availability' => 'Available for projects',
            'years_experience' => 5,
            'projects_count' => 50,
            'clients_count' => 30,
            'email' => 'info@lyxweb.co.tz',
            'phone' => '+255 757 585 640',
            'whatsapp_url' => 'https://wa.me/255757585640',
            'location' => 'Tanzania',
            'website_url' => 'https://lyxweb.co.tz',
            'meta_description' => 'Felix Nelsony is a software engineer in Tanzania building high-performance web platforms, mobile apps, and digital products.',
        ]);

        $projects = [
            [
                'title' => 'KKKT Digital Platform',
                'category' => 'SaaS',
                'short_description' => 'A digital church ecosystem bringing communication, learning, and services together.',
                'description' => 'A digital platform for the Evangelical Lutheran Church in Tanzania. It supports diocesan and parish communication, sermon distribution, digital learning, an e-bookstore, and mobile money payments.',
                'technologies' => ['Laravel', 'Livewire', 'Tailwind CSS', 'MySQL', 'REST APIs'],
                'accent_color' => '#7c8cff',
                'cover_image_url' => '/images/projects/kkkt-digital-platform.svg',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Joseph M. Kusaga Portal',
                'category' => 'Web App',
                'short_description' => 'An executive platform for leadership, business ventures, and media.',
                'description' => 'A polished digital hub for Joseph M. Kusaga, CEO of Clouds Media Group. The platform brings together his career, business portfolio, philanthropic initiatives, keynote appearances, and media coverage.',
                'technologies' => ['Laravel', 'Livewire', 'Tailwind CSS', 'MySQL'],
                'accent_color' => '#d8a970',
                'cover_image_url' => '/images/projects/joseph-m-kusaga-portal.svg',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'DD Jets Aviation System',
                'category' => 'Enterprise App',
                'short_description' => 'A private aviation booking and fleet management experience.',
                'description' => 'A private jet charter platform for flight requests, aircraft information, schedule coordination, and VIP client support. The system brings the booking journey and fleet operations into one focused experience.',
                'technologies' => ['Laravel', 'React', 'Tailwind CSS', 'PostgreSQL'],
                'accent_color' => '#81d9cc',
                'cover_image_url' => '/images/projects/dd-jets-aviation-system.svg',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Lyx VPN Tunnel App',
                'category' => 'Mobile App',
                'short_description' => 'A cross-platform mobile VPN client with a simple, secure connection flow.',
                'description' => 'A Flutter mobile application for encrypted connections, node selection, connection status, and bandwidth monitoring, designed for a clear and reliable everyday experience.',
                'technologies' => ['Flutter', 'Dart', 'WireGuard', 'REST APIs'],
                'accent_color' => '#74a7ff',
                'cover_image_url' => '/images/projects/lyx-vpn-tunnel-app.svg',
                'is_featured' => false,
                'sort_order' => 4,
            ],
            [
                'title' => 'SMY Real Estate',
                'category' => 'SaaS',
                'short_description' => 'A property platform connecting people with homes and real estate professionals.',
                'description' => 'A real estate platform with property discovery, location and amenity filters, property detail pages, image galleries, and tools for managing enquiries and agent leads.',
                'technologies' => ['Laravel', 'Livewire', 'MySQL', 'JavaScript'],
                'accent_color' => '#e4a58d',
                'cover_image_url' => '/images/projects/smy-real-estate.svg',
                'is_featured' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'CMT Artisans Directory',
                'category' => 'Enterprise App',
                'short_description' => 'A national directory connecting people with skilled Tanzanian artisans.',
                'description' => 'A membership and services platform for technicians and craftspeople. It supports professional profiles, qualification checks, service requests, and member directory features.',
                'technologies' => ['Laravel', 'Livewire', 'MySQL', 'Tailwind CSS'],
                'accent_color' => '#e8c970',
                'cover_image_url' => '/images/projects/cmt-artisans-directory.svg',
                'is_featured' => false,
                'sort_order' => 6,
            ],
            [
                'title' => 'MBAPAO M&E System',
                'category' => 'Enterprise App',
                'short_description' => 'A monitoring and evaluation system for a community paralegal organisation.',
                'description' => 'A custom monitoring and evaluation system for the Mbalizi Paralegal Organization, supporting the collection and review of programme data.',
                'technologies' => ['Laravel', 'Livewire', 'MySQL', 'Bootstrap'],
                'accent_color' => '#c396ff',
                'cover_image_url' => '/images/projects/mbapao-me-system.svg',
                'is_featured' => false,
                'sort_order' => 7,
            ],
        ];

        foreach ($projects as $position => $project) {
            Project::query()->updateOrCreate(
                ['slug' => str($project['title'])->slug()],
                [...$project, 'slug' => str($project['title'])->slug(), 'is_published' => true, 'sort_order' => $position + 1],
            );
        }

        $services = [
            ['title' => 'Web Development', 'summary' => 'Fast, accessible websites and business platforms built around the way your team works.', 'icon' => '⌘', 'technologies' => ['Laravel', 'Livewire', 'Vue.js', 'Tailwind CSS']],
            ['title' => 'Product & UI/UX Design', 'summary' => 'Clear user journeys and refined interfaces that make complex tools feel simple.', 'icon' => '✳', 'technologies' => ['Figma', 'Prototyping', 'Design systems']],
            ['title' => 'Mobile Applications', 'summary' => 'Cross-platform mobile apps with thoughtful flows and dependable integrations.', 'icon' => '↗', 'technologies' => ['Flutter', 'Dart', 'Firebase']],
            ['title' => 'Brand Identity', 'summary' => 'Distinctive visual systems that give your product a consistent, memorable voice.', 'icon' => '◈', 'technologies' => ['Brand strategy', 'Identity', 'Guidelines']],
        ];

        foreach ($services as $position => $service) {
            Service::query()->updateOrCreate(
                ['title' => $service['title']],
                [...$service, 'is_visible' => true, 'sort_order' => $position + 1],
            );
        }

        $skills = [
            'Frontend' => ['JavaScript', 'Vue.js', 'React', 'Tailwind CSS', 'Livewire'],
            'Backend' => ['PHP', 'Laravel', 'Python', 'Node.js', 'MySQL', 'PostgreSQL'],
            'Mobile' => ['Flutter', 'Dart', 'Firebase'],
            'Design' => ['Figma', 'Photoshop', 'Illustrator', 'Premiere Pro'],
            'Tools' => ['Git', 'Docker', 'Linux', 'AWS', 'Postman'],
        ];

        foreach ($skills as $group => $names) {
            foreach ($names as $position => $name) {
                Skill::query()->updateOrCreate(
                    ['name' => $name, 'group' => $group],
                    ['sort_order' => $position + 1],
                );
            }
        }
    }
}

