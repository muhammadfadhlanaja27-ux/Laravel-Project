<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    private $siteData;

    public function __construct()
    {
        // Data global untuk semua halaman
        $this->siteData = [
            'site_name' => 'PortoFolio',
            'site_author' => 'Muhammad Fadhlan Pratama',
            'site_email' => 'muhammadfadhlanaja27@gmail.com',
            'site_phone' => '+62 8953 3274 0062',
            'site_address' => 'Maleber Utara, Bandung',
        ];
    }

    public function home()
    {
        $data = array_merge($this->siteData, [
            'page_title' => 'Home - Portfolio',
            'hero' => [
                'name' => 'Muhammad Fadhlan Pratama',
                'roles' => ['Fotografer', 'Data Analsyt', 'UI/UX Designer', 'Web Developer'],
                'description' => 'Passionate about capturing moments, crafting intuitive designs, and transforming data into meaningful insights that inspire better experiences.',
                'image' => 'assets/img/profile/profile-1.jpg'
            ],
            'stats' => [
                ['icon' => 'bi-emoji-smile', 'number' => 232, 'label' => 'Happy Clients'],
                ['icon' => 'bi-journal-richtext', 'number' => 521, 'label' => 'Projects'],
                ['icon' => 'bi-headset', 'number' => 1463, 'label' => 'Hours Of Support'],
                ['icon' => 'bi-people', 'number' => 15, 'label' => 'Hard Workers'],
            ]
        ]);

        return view('home', $data);
    }

    public function about()
    {
        $data = array_merge($this->siteData, [
            'page_title' => 'About Us - Portfolio',
            'profile' => [
                'name' => 'Muhammad Fadhlan Pratama',
                'profession' => 'Photographer & Data Analyst',
                'email' => 'muhammadfadhlanaja27@gmail.com',
                'phone' => '+62 8953 3274 0062',
                'location' => 'Maleber Utara, Bandung',
                'image' => 'assets/img/profile/profile-1.jpg',
                'description' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.'
            ],
            'stats' => [
                ['number' => '150+', 'label' => 'Projects Completed'],
                ['number' => '5+', 'label' => 'Years Experience'],
                ['number' => '98%', 'label' => 'Client Satisfaction'],
            ],
            'details' => [
                ['label' => 'Specialization', 'value' => 'Photographer & Data Analysis'],
                ['label' => 'Experience Level', 'value' => 'Junior'],
                ['label' => 'Education', 'value' => 'Rekayasa Perangkat Lunak, SMKN 11 Bandung'],
                ['label' => 'Languages', 'value' => 'English, Tagalog'],
            ],
            'skills' => [
                ['name' => 'Photographer', 'percentage' => 95],
                ['name' => 'Python', 'percentage' => 90],
                ['name' => 'JavaScript', 'percentage' => 80],
                ['name' => 'Node.js', 'percentage' => 75],
            ]
        ]);

        return view('about', $data);
    }

    public function resume()
    {
        $data = array_merge($this->siteData, [
            'page_title' => 'Resume - Portfolio',
            'profile_image' => 'assets/img/profile/profile-1.jpg',
            'summary' => 'Driven software architect with expertise in developing scalable, high-performance enterprise solutions. Passionate about leveraging cutting-edge technologies to solve complex business challenges.',
            'contact_info' => [
                ['icon' => 'bi-geo-alt', 'text' => '742 Evergreen Terrace, Springfield, MA 02101'],
                ['icon' => 'bi-envelope', 'text' => 'contact@example.com'],
                ['icon' => 'bi-phone', 'text' => '+1 (555) 123-4567'],
                ['icon' => 'bi-linkedin', 'text' => 'linkedin.com/in/example'],
            ],
            'technical_skills' => [
                ['name' => 'Web Development', 'percentage' => 95],
                ['name' => 'UI/UX Design', 'percentage' => 85],
                ['name' => 'Cloud Architecture', 'percentage' => 90],
                ['name' => 'Project Management', 'percentage' => 80],
            ],
            'experience' => [
                [
                    'title' => 'Senior Software Architect',
                    'period' => '2022 - Present',
                    'company' => 'Tech Innovations Inc.',
                    'responsibilities' => [
                        'Lead the architectural design and implementation of enterprise-scale applications',
                        'Mentor team of 12 developers and establish technical best practices',
                        'Drive adoption of microservices architecture and cloud-native solutions',
                        'Reduce system downtime by 75% through improved architecture and monitoring'
                    ]
                ],
                [
                    'title' => 'Lead Developer',
                    'period' => '2019 - 2022',
                    'company' => 'Digital Solutions Corp.',
                    'responsibilities' => [
                        'Spearheaded development of company\'s flagship product reaching 1M+ users',
                        'Implemented CI/CD pipeline reducing deployment time by 60%',
                        'Managed team of 8 developers across multiple projects',
                        'Increased code test coverage from 45% to 90%'
                    ]
                ],
            ],
            'education' => [
                [
                    'degree' => 'Master of Science in Computer Science',
                    'period' => '2017 - 2019',
                    'institution' => 'Stanford University',
                    'description' => 'Specialized in Artificial Intelligence and Machine Learning. Graduated with honors.'
                ],
                [
                    'degree' => 'Bachelor of Science in Software Engineering',
                    'period' => '2013 - 2017',
                    'institution' => 'MIT',
                    'description' => 'Dean\'s List all semesters. Led university\'s coding club.'
                ],
            ],
            'certifications' => [
                ['title' => 'AWS Certified Solutions Architect - Professional', 'year' => '2023'],
                ['title' => 'Google Cloud Professional Architect', 'year' => '2022'],
            ]
        ]);

        return view('resume', $data);
    }

    public function portfolio()
    {
        $data = array_merge($this->siteData, [
            'page_title' => 'Portfolio - Portfolio',
            'categories' => [
                ['slug' => '*', 'name' => 'All Projects'],
                ['slug' => 'photography', 'name' => 'Photography'],
                ['slug' => 'design', 'name' => 'Design'],
                ['slug' => 'automotive', 'name' => 'Automotive'],
                ['slug' => 'nature', 'name' => 'Nature'],
            ],
            'projects' => [
                [
                    'title' => 'Capturing Moments',
                    'category' => 'photography',
                    'category_name' => 'Photography',
                    'image' => 'assets/img/portfolio/portofolio-portrait-1.jpg',
                    'link' => route('portfolio.detail', 1)
                ],
                [
                    'title' => 'Woodcraft Design',
                    'category' => 'design',
                    'category_name' => 'Web Design',
                    'image' => 'assets/img/portfolio/portofolio-2.jpg',
                    'link' => route('portfolio.detail', 2)
                ],
                [
                    'title' => 'Classic Beauty',
                    'category' => 'automotive',
                    'category_name' => 'Automotive',
                    'image' => 'assets/img/portfolio/portofolio-portrait-2.png',
                    'link' => route('portfolio.detail', 3)
                ],
                [
                    'title' => 'Natural Growth',
                    'category' => 'nature',
                    'category_name' => 'Nature',
                    'image' => 'assets/img/portfolio/portofolio-portrait-4.jpg',
                    'link' => route('portfolio.detail', 4)
                ],
                [
                    'title' => 'Urban Stories',
                    'category' => 'photography',
                    'category_name' => 'Photography',
                    'image' => 'assets/img/portfolio/portfolio-5.webp',
                    'link' => route('portfolio.detail', 5)
                ],
                [
                    'title' => 'Digital Experience',
                    'category' => 'design',
                    'category_name' => 'Web Design',
                    'image' => 'assets/img/portfolio/portfolio-6.webp',
                    'link' => route('portfolio.detail', 6)
                ],
            ]
        ]);

        return view('portfolio', $data);
    }

    public function portfolioDetail($id)
    {
        // Simulasi data portfolio detail
        $projects = [
            1 => [
                'title' => 'Capturing Moments',
                'category' => 'Photography',
                'client' => 'Victoria Technologies',
                'date' => '01 March, 2024',
                'url' => 'www.example.com',
                'images' => [
                    'assets/img/portfolio/portfolio-1.webp',
                    'assets/img/portfolio/portfolio-10.webp',
                    'assets/img/portfolio/portfolio-7.webp',
                ],
                'description' => 'Autem ipsum nam porro corporis rerum. Quis eos dolorem eos itaque inventore commodi labore quia quia.',
                'features' => [
                    ['icon' => 'bi-check-circle-fill', 'title' => 'Responsive Design', 'desc' => 'Voluptatum deleniti atque corrupti quos dolores'],
                    ['icon' => 'bi-shield-check', 'title' => 'Advanced Security', 'desc' => 'Minim veniam, quis nostrud exercitation'],
                    ['icon' => 'bi-graph-up', 'title' => 'Performance Optimization', 'desc' => 'Duis aute irure dolor in reprehenderit'],
                    ['icon' => 'bi-gear', 'title' => 'Easy Integration', 'desc' => 'Excepteur sint occaecat cupidatat non proident'],
                ]
            ]
        ];

        $project = $projects[$id] ?? $projects[1];

        $data = array_merge($this->siteData, [
            'page_title' => $project['title'] . ' - Portfolio Detail',
            'project' => $project
        ]);

        return view('portfolio-detail', $data);
    }

    public function contact()
    {
        $data = array_merge($this->siteData, [
            'page_title' => 'Contact - Portfolio',
            'contact_info' => [
                [
                    'icon' => 'bi-geo-alt',
                    'title' => 'Our Location',
                    'lines' => ['No 101 Maleber Utara', 'Bandung, Jawa Barat']
                ],
                [
                    'icon' => 'bi-telephone',
                    'title' => 'Phone Number',
                    'lines' => ['+62 8953 3274 0062']
                ],
                [
                    'icon' => 'bi-envelope',
                    'title' => 'Email Address',
                    'lines' => ['muhammadfadhlanaja27@gmai.com']
                ],
            ]
        ]);

        return view('contact', $data);
    }

    public function contactSubmit(Request $request)
    {
        // Validasi form
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'subject' => 'required|max:255',
            'message' => 'required',
        ]);

        // Proses kirim email atau simpan ke database
        // Mail::to('admin@example.com')->send(new ContactMail($validated));

        return redirect()->route('contact')->with('success', 'Your message has been sent. Thank you!');
    }
}