<?php

namespace Database\Seeders;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Fills a new database with your admin login and your resume details.
 * It is safe to run twice: it only adds what is missing.
 *
 * Run it with:  php artisan migrate --seed
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->createAdmin();
        $this->createProfile();
        $this->createSkills();
        $this->createProjects();
        $this->createExperience();
        $this->createEducation();
        $this->createSettings();
    }

    private function createAdmin(): void
    {
        $email = env('ADMIN_EMAIL', 'tanishkapatilwork@gmail.com');
        $password = env('ADMIN_PASSWORD');

        if (! $password) {
            if (app()->isProduction()) {
                $this->command->error('Set ADMIN_PASSWORD in your .env file before seeding on a live server.');

                return;
            }

            $password = 'ChangeMe@123';
            $this->command->warn("No ADMIN_PASSWORD in .env, so the temporary password is: {$password}");
            $this->command->warn('Change it after your first login (Website Settings, Change password).');
        }

        // firstOrCreate: an existing admin (and a changed password) is never overwritten.
        User::firstOrCreate(
            ['email' => $email],
            ['name' => 'Tanishka Patil', 'password' => Hash::make($password)]
        );
    }

    private function createProfile(): void
    {
        if (Profile::count() > 0) {
            return;
        }

        Profile::create([
            'name' => 'Tanishka Patil',
            'headline' => 'Frontend & Laravel Developer',
            'short_intro' => 'Computer Science graduate passionate about building responsive websites and dynamic web applications.',
            'about' => "I am a BSc Computer Science graduate from Mumbai with hands-on experience in PHP, Laravel, MySQL and front-end technologies.\n\n"
                . "I built SkillSwap, a skill exchange platform in Laravel, and completed a Java development internship where I built a Student Management System in Core Java and rebuilt it with Spring Boot and REST APIs.\n\n"
                . 'I enjoy turning ideas into clean, mobile-friendly websites and admin panels, and I am open to freelance projects and full-time roles.',
            'email' => 'tanishkapatilwork@gmail.com',
            'phone' => '+91 84214 90719',
            'whatsapp' => '918421490719',
            'location' => 'Mumbai, Maharashtra',
            'github' => 'https://github.com/tanishkap31',
            'linkedin' => 'https://www.linkedin.com/in/tanishka-patil31',
            'open_for_work' => true,
        ]);
    }

    private function createSkills(): void
    {
        if (Skill::count() > 0) {
            return;
        }

        $groups = [
            'Back end' => ['PHP', 'Laravel', 'Core Java', 'Spring Boot', 'REST API'],
            'Front end' => ['HTML5', 'CSS3', 'JavaScript', 'jQuery', 'Bootstrap'],
            'Database' => ['MySQL', 'SQL Server'],
            'Tools' => ['Git', 'GitHub', 'VS Code', 'Postman', 'Netlify'],
        ];

        $order = 1;
        foreach ($groups as $category => $names) {
            foreach ($names as $name) {
                Skill::create(['name' => $name, 'category' => $category, 'sort_order' => $order++]);
            }
        }
    }

    private function createProjects(): void
    {
        if (Project::count() > 0) {
            return;
        }

        Project::create([
            'title' => 'SkillSwap',
            'tagline' => 'A platform where people exchange skills and connect with other learners.',
            'description' => 'SkillSwap is a web platform that allows users to exchange skills and connect with other learners. I built the backend with Laravel and MySQL, following the MVC architecture.',
            'tools' => 'PHP, Laravel, MySQL, HTML, CSS, JavaScript',
            'highlights' => "Backend features built with the Laravel framework\n"
                . "Database migrations, models, controllers and application routing\n"
                . "CRUD operations and relational data handling in MySQL\n"
                . 'Backend code organised with the MVC architecture',
            'is_published' => true,
            'sort_order' => 1,
        ]);

        Project::create([
            'title' => 'Student Management System',
            'tagline' => 'Built twice: first in Core Java with JDBC, then rebuilt with Spring Boot.',
            'description' => 'A student management application built during my Java development internship. The first version used Core Java with JDBC and MySQL. I then rebuilt it with Spring Boot and Spring Data JPA, exposing REST API endpoints.',
            'tools' => 'Core Java, JDBC, MySQL, Spring Boot, Spring Data JPA, REST API, Postman',
            'highlights' => "Core Java version connected to MySQL through JDBC with PreparedStatement\n"
                . "OOP concepts with code split into model, DAO and menu classes\n"
                . "Spring Boot version with REST endpoints for CRUD and search\n"
                . 'Controller, service and repository structure, tested with Postman',
            'is_published' => true,
            'sort_order' => 2,
        ]);
    }

    private function createExperience(): void
    {
        if (Experience::count() > 0) {
            return;
        }

        Experience::create([
            'company' => 'IT Vedant Education Pvt. Ltd.',
            'role' => 'Java Development Intern',
            'duration' => 'November 2025 - January 2026',
            'description' => "Built a Student Management System in Core Java, connected to MySQL through JDBC using SQL queries and PreparedStatement\n"
                . "Applied OOP concepts and structured the code into model, DAO and menu classes\n"
                . "Rebuilt the application with Spring Boot and Spring Data JPA, exposing REST API endpoints for CRUD and search\n"
                . 'Debugged errors, validated input and worked with Core Java, JDK, Eclipse IDE, MySQL and Postman',
            'sort_order' => 1,
        ]);
    }

    private function createEducation(): void
    {
        if (Education::count() > 0) {
            return;
        }

        Education::create([
            'degree' => 'Bachelor of Science in Computer Science',
            'college' => "Sonopant Dandekar Shikshan Mandali's, Palghar",
            'university' => 'University of Mumbai',
            'duration' => '2026',
            'grade' => 'CGPA 8.51',
            'sort_order' => 1,
        ]);
    }

    private function createSettings(): void
    {
        if (Setting::count() > 0) {
            return;
        }

        Setting::put('site_title', 'Tanishka Patil');
        Setting::put('meta_description', 'Portfolio of Tanishka Patil, a frontend and Laravel developer in Mumbai. PHP, Laravel, MySQL, JavaScript.');
        Setting::put('notify_email', 'tanishkapatilwork@gmail.com');
        Setting::put('default_theme', 'auto');
    }
}
