GolderAzorsVote is a web application that allows creating polls with multiple rounds, managing users, and voting after logging in.
The project is built with Laravel 12, Vue.js, Inertia.js, and Vite.

Planned Features

-> User registration and login
-> Creating polls

Two types of polls:
    - Open polls (any logged-in user can vote)
    - Closed polls (the poll manager can invite specific users)

Poll rounds with:
    - Text
    - Optional picture
    - YouTube link for videos
    - Option to allow users to select multiple options in one round

Poll statistics:
    - Results
    - Who voted, when, and for what
    - Optional visibility of results for other users

Admin panel (managing users and polls)

Logging in required to cast a vote

Future development
    - Real-time results using WebSockets / Laravel Echo

Technology stack
    - Laravel 12
    - PHP 8.3+
    - MariaDB
    - Vue 3 (Script Setup)
    - Inertia.js
    - Vite
    - TailwindCSS
    - Laravel Breeze