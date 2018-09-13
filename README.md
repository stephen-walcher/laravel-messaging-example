# Example Laravel Messaging System
A small application to demonstrate one-way messaging with Laravel.

## Creator
Stephen Walcher (stephenwalcher@gmail.com)

## Components Used
* Docker/Docker Compose
* Laravel
* Laravel Echo Server
* Redis
* Vue.js
* Webpack
* Bootstrap
* SASS
* Mariadb

## Installation
To install this application, make sure that you have Docker and Docker Compose installed, then run `docker-compose up --build` from your command line in the root folder. After all containers and components have been downloaded and installed, you should be able to use the application normally.

*Note: It will take a few minutes to fully download and install all components*

## How to Use
Once the Docker environment has been fully brought up, the application can be accessed by visiting `http://localhost:8080` in a modern browser (Chrome, Firefox, etc.).

The application recognizes two types of users: the "Admin" and their "Clients". "Client" users will visit the application starting at `http://localhost:8080` to begin. Once there, they will register their name and be taken to a page that will listen to specific messages sent to them.

The "Admin" user will access the application at `http://localhost:8080/admin` to see their dashboard. From there, the "admin" user will be able to send new messages to "client" users. The message can be sent to as many "client" users as desired, by checking on the names they wish to send to. A message can also be scheduled to be sent at a specific time by selecting a date/time. (If no date/time is selected, the message will be sent immediately)

"Admin" users will also be able to view previously sent messages on this page.

*Note: You will need to refresh the "Admin" dashboard to see any new "client" users that have registered their session. See below for plans to remove that requirement.*

## TODO
I've only just started working on this project and have spent a total of around 4 hours developing this. Over time, I'd like to make the following additions/modifications:

#### Add proper Laravel user support
Currently, the system only registers a new user. I would like to add in support for the native Laravel user system, which would allow for full logging in, registration, etc. This will also require a mail service to be created in the Docker environment.

#### Add support for private and presence channels
Because the native Laravel user system is not being used, authentication cannot be made for Private and Presence channels in the Echo server. With the user system in place, I'll be able to move all listening to specific private channels for each user. This will also allow me to utilize a Presence channel to notify the Admin dashboard when users register or stop using the application, which will allow me to dynamically adjust the list of recipients to only those who are online.

#### Add two-way and client-to-client messaging
Laravel Echo is a powerful server and, once the user system has been implemented, will allow for much more functionality than what's currently in the system. I'd like to add the capability for "clients" to message back to the "admin" user and for "clients" to be able to message each other.

#### Add ability for missed messages to be received on login
Once the user system has been implemented, checks can be made against the messages table to allow for collecting of any messages that may have been sent to the user while they were logged off and displaying them when the user logs back in. This could also allow for the functionality on the "Admin" dashboard to show all possible users when sending a message, but to visually indicate which are currently online and which aren't.

#### Make better use of the Vue.js framework
Vue.js is meant to be an SPA (Single Page Application). Laravel makes it easy to use Vue in their applications, but it's difficult to properly utilize Blade templates and still have everything reside within one page. I'd like to refactor the UI to be on its own service, utilizing Vue.js to make a true Single Page Application, with the Laravel service residing as a RESTful API.

#### Add better date scheduling support in the UI
The currently used date picker plugin only works for selecting date. I'd like to replace it with a plugin that also selects time and properly works with Bootstrap 4.
