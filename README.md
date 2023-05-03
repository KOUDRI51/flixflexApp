FlixFlex


 FlixFlex is a web application that allows users to browse and search for movies and TV shows, view details about them, and have account for favorites Movies.
Table of Contents:

•	Technologies Used
•	 Getting Started 
•	Usage 
•	Contributing 
•	License 

Technologies Used
  FlixFlex is built using the following technologies:
 
     PHP 8 
     Symfony 6
     MySQL database 
     The Movie Database API (https://www.themoviedb.org/documentation/api)

Getting Started 
 To get started with FlixFlex, follow these steps:

Clone the repository to your local machine:
bash Copy code git clone https://github.com/YOUR_USERNAME/flixflex.git Install the necessary dependencies:
Copy code composer install
Create a new MySQL database and update the .env file with your database credentials:
bash Copy code DATABASE_URL=mysql://db_user:db_pass@127.0.0.1:3306/namedatabase Create the necessary database tables:
bash Copy code php bin/console doctrine:migrations:migrate 
Register for an API key from The Movie Database API (https://www.themoviedb.org/documentation/api) and update the .env file with your API key:
makefile Copy code TMDB_API_KEY=your_api_key
Start the development server:
sql Copy code symfony server:start

Usage

 FlixFlex allows users to browse and search for movies and TV shows, view details about them, and save or edit their favorites.
Browse movies and TV shows To browse movies and TV shows, go to the home page (/). Here you can see the top-rated movies and TV shows, as well as the latest releases.
Search for movies and TV shows To search for movies and TV shows, use the search bar at the top of the page. Enter your search query and press enter. You will be taken to a search results page where you can see a list of movies and TV shows that match your search.
View details about a movie or TV show To view details about a movie or TV show, click on the title of the movie or TV show. You will be taken to a details page where you can see information about the movie or TV show, including its title, release date, overview, and rating.
Save favorites To save a movie or TV show as a favorite, click the heart icon on the details page. You will be prompted to log in or create an account if you haven't already done so. Once you're logged in, the movie or TV show will be added to your list of favorites.

Contributing 

If you'd like to contribute to FlixFlex, please fork the repository and make your changes there. Once you're ready, submit a pull request and we'll review your changes.

License 

FlixFlex is licensed under the MIT license. See LICENSE for more information.





