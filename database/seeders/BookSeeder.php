<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kitoblar ro'yxati
        $books = [
            [
                'title' => 'Clean Code',
                'subtitle' => 'A Handbook of Agile Software Craftsmanship',
                'publisher' => 'Prentice Hall',
                'language' => 'English',
                'description' => 'Clean Code is a book about the principles and best practices of writing clean, maintainable code.',
                'image' => 'clean-code.jpg',
            ],
            [
                'title' => 'The Pragmatic Programmer',
                'subtitle' => 'Your Journey to Mastery',
                'publisher' => 'Addison-Wesley',
                'language' => 'English',
                'description' => 'The Pragmatic Programmer is a book about becoming a better software developer.',
                'image' => 'pragmatic-programmer.jpg',
            ],
            [
                'title' => 'Introduction to Algorithms',
                'subtitle' => 'Third Edition',
                'publisher' => 'MIT Press',
                'language' => 'English',
                'description' => 'An essential guide to algorithms used in computer science.',
                'image' => 'intro-to-algorithms.jpg',
            ],
        ];

        // Ma'lumotlarni bazaga yuklash
        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
