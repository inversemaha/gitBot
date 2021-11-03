## Objective:
We want to build a Laravel app, where we can input any GitHub username. It should be able to show a list of repositories of that user. Behind the scene, it would retrieve that data from Github's API and store those data info in our database.

## API
Use Github's free API to extract user info and a list of repositories of any user.
1. Example User info: `https://api.github.com/users/{username}` or https://api.github.com/users/taylorotwell
2. List of repositories: `https://api.github.com/users/{username}/repos` or https://api.github.com/users/taylorotwell/repos

## Steps:
- Create a new Laravel app

- Models
    - User
    - Repository

- Relationships
    - User hasMany Repositories

- Interface
    - It should have an input box to enter "GitHub Username" and a submit button.
    - On submit, it will show a list of that user's repositories

- Functionality
    - On submit it would check if that username already exists in our database.
    - When username exists
        - It should show the user's name, avatar, and list of repositories.
    - When username doesn't exist on the database
        - It would get that info from Github's API
        - Save the user info and list of repositories to the database
        - It would also download the user's avatar to the app's public storage using Laravel's queue system.
        - Show the user's name, avatar, and list of repositories on the page.

- Error Handling
    - Should handle error responses from the API.
    - Example error: User Not Found https://api.github.com/users/404

- Frontend
    - You are free to use any frontend framework like bootstrap, tailwindcss

- Testing (Optional)
    - Write PHPUnit tests of the features

## Time
1.5 hour
