
# IUT_SilexBlog
Website (in fact, Blog) made for "Projet Web" lessons @ Lyon1 University

# How to test it

- Generate the Database with one of the scripts located in the `DATABASE` folder
(`silexblog_db_exported.sql` is the most advanced version, exported under phpMyAdmin, while `silexblog_db_generation.sql` is the simple hand-made one)
- Modify Database informations in `index.php` (lines 26 to 33)
- You can then access the site, and try the different functions with the following credentials

Role | Username | Password
--- | --- | ---
Admin | Admin | Admin
Admin | TBG | azerty
User | Jean | 11
Role | Hubert | 11

# Implemented Functions

## As a Guest
- Display all post (homepage)
- Display a single post (read that post)
- Display all comments on a post, or all comments of a post
- Display a single comment (by clicking on its #id)
- Acceed to the Authentification page (login), in order to Login/Register

## As a Logged User
- All the guest functions
- Acceed to the 'User Panel'
- Add a new comment anywhere
- Edit or Remove personal comments

## As an Admin
- All the user functions
- Acceed to the 'Admin Panel'
- Display all posts, without images/content (short list)
- Edit or Remove any post
- Delete any comment
- Display a list of comment, without having to choose one specifical post

# Bug & Fixes

## 1. EntityManager & Service
I tried to create a service named UserManagement, but to do so, I had to add the EntityManager into that Service, which is apparently a complicated thing...
You'll find more about that into /src/Services/removed_UserManagement (many useful links, mainly)
I fixed that by putting the UserManagement class in the 'index.php' file, after the code related to the app and the routes.

## 2. Exceptions
I tried to add Exception to manage authentification errors. I already did a similar thing for a PHP School project, and it worked. Here, Silex "overrides" my code and I can't catch those exceptions...
So you'll have to go to the previous page if you make a mistake when logining/registering.

## 3. Redirections (e.g. Comments Deletion)
After a comment deletion, you'll be redirected on the "comments only" page linked to the post that used to contain that comment
It's the same for some actions, I didn't managed to send back the user on the page he was before clicking/doing some actions

# Improvements

- We could add a button to the "Edit Post" page, allowing the user to delete/remove the image linked to the post
- I decided to not hash the passwords, making it easier for me while developping (it could be done really easily, with the 'hash()' function stored inside the UserManagement class)
- The 'Comments Management' page isn't finished, it would need some modifications into 'comments_display_list.twig', but nothing really important as it works
- I thought about a 'User Management' page, that could allow Administrators to remove/edit some Users, but I didn't made it (yet)
- Same thing about 'User Profile' page, to manage personal informations

`Tom-Brian Garcia - DUT Informatique 2A - Bourg-en-Bresse (Lyon1)`
