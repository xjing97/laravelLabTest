<?php

use Illuminate\Database\Seeder;
use App\Movie;
use App\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS=0');

      $this->call(MoviesTableSeeder::class);
      $this->call(CategoriesTableSeeder::class);

      DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

}

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->truncate();
        foreach(['Action', 'Comedy', 'Adventure','Animation','Fantasy','Horror','Romance','Documentary','Science Fiction','Family'] as $category) {
            Category::create(['name' => $category]);
        }
    }
}

class MoviesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('movies')->truncate();
        Movie::create(['user_id'=>'2','name' => 'Captain Marvel', 'year'=>2019, 'category_id' => 1,'description' => 'Brie Larson as Carol Danvers / Vers / Captain Marvel: An ex-U.S. Air Force fighter pilot and member of an elite Kree military unit called Starforce whose DNA was altered during an accident, imbuing her with superhuman strength, energy projection, and flight.']);
        Movie::create(['user_id'=>'1','name' => 'US', 'year'=>2019, 'category_id' => 6,'description' => 'Us is a 2019 American horror film written and directed by Jordan Peele. The film stars Lupita Nyong, Winston Duke, Shahadi Wright Joseph, Evan Alex, Elisabeth Moss, and Tim Heidecker, and follows a family who are confronted by their doppelgängers.']);
        Movie::create(['user_id'=>'2','name' => 'Avengers: Endgame'  , 'year'=>2019, 'category_id' => 1,'description' => 'Adrift in space with no food or water, Tony Stark sends a message to Pepper Potts as his oxygen supply starts to dwindle. Meanwhile, the remaining Avengers -- Thor, Black Widow, Captain America and Bruce Banner -- must figure out a way to bring back their vanquished allies for an epic showdown with Thanos -- the evil demigod who decimated the planet and the universe.']);
        Movie::create(['user_id'=>'3','name' => 'Dumbo', 'year'=>2019, 'category_id' => 10,'description' => 'A young elephant, whose oversized ears enable him to fly, helps save a struggling circus, but when the circus plans a new venture, Dumbo and his friends discover dark secrets beneath its shiny veneer. Holt was once a circus star, but he went off to war and when he returned it had terribly altered him.']);
        Movie::create(['user_id'=>'3','name' => 'Wonder Park' , 'year'=>2019, 'category_id' => 2,'description' => 'Wonder Park tells the story of an amusement park where the imagination of a wildly creative girl named June comes alive.']);
        Movie::create(['user_id'=>'2','name' => 'Frozen 2' , 'year'=>2019, 'category_id' => 4,'description' => 'Frozen 2 (stylized as Frozen II) is an upcoming American computer-animated musical fantasy film in production by Walt Disney Animation Studios, and is the sequel to Frozen (2013).']);
    }
}
