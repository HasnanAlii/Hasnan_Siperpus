<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::insert([
            // [
                "title" => "Jarkom - Filosofi",
                "author" => "Budi Pratama",
                "year" => 2024,
                "publisher" => "Universitas Suryakancana",
                "city" => "Cianjur", 
                "cover" => "public/cover.jpg",
                "bookshelf_id" => 1
            ],
            // [
            //     "title" => "Algoritma - Konsep Dasar",
            //     "author" => "Rina Sutrisna",
            //     "year" => 2023,
            //     "publisher" => "Universitas Teknologi Bandung",
            //     "city" => "Bandung", 
            //     "cover" => "public/algoritma.jpg",
            //     "bookshelf_id" => 2
            // ],
            // [
            //     "title" => "Pemrograman Berbasis Objek",
            //     "author" => "Dedi Santoso",
            //     "year" => 2022,
            //     "publisher" => "Politeknik Negeri Jakarta",
            //     "city" => "Depok", 
            //     "cover" => "public/oop.jpg",
            //     "bookshelf_id" => 3
            // ]
        // ]
    );
        
        
    }
}
