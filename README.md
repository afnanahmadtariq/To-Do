# To-Do List PHP Application

This is a simple PHP application that allows users to signup, login, and manage their to-do list tasks. The application uses MongoDB for storing user and task data, and the MongoDB URI is loaded from an environment variable.

## Features
- **User Authentication:** Signup and Login functionality.
- **Task Management:** Add and delete tasks for your to-do list.
- **MongoDB Integration:** Uses MongoDB as the database.
- **Environment Configuration:** MongoDB URI is read from the environment.

## File Structure

```
yourapp/ 
├── index.php 
├── dashboard.php 
├── logout.php 
├── config.php 
├── composer.json 
└── README.md
```

## Prerequisites
- PHP 7.2 or above
- Composer
- Apache2 Web Server (or your preferred web server)
- MongoDB server and the MongoDB PHP extension

## Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/afnanahmadtariq/To-Do.git
   cd yourapp
