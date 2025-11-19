# Logbook - Blog App

Welcome to **Logbook**, a complete modern blog application created with **Laravel**. This platform lets users manage posts, engage with content through comments and likes, and follow other users.

![head](https://res.cloudinary.com/dhh432tdg/image/upload/v1763564397/Screenshot_688_a1cwd3.png)

## ✨ Features

This application has a complete set of features for a modern blogging experience:

### 👤 User Management & Authentication

*   **Full Authentication:** Login, registration, and logout functionality.
    
*   **Profile Management:** Users can view and update their profiles.
    
*   **Avatar Management:** Implement features for uploading and deleting avatars.
    
*   **Follow/Unfollow:** Functionality to follow and unfollow other users.
    

### 📝 Post Management

*   **Post CRUD:** Create, read, update, and delete posts.
    
*   **Post Creation:** Includes validation to ensure data integrity.


### 💬 Interaction & Community

*   **Commenting:** Implement the ability to create and delete comments, along with the necessary routes and views.
    
*   **Liking:** Added "like" functionality on posts.
    
*   **Search:** Feature to search for user to follow.
    
*   **Pagination:** Implemented for posts to improve performance and navigation.
    

### 🛠️ Technical Details & Enhancements

*   **Dependencies:** Integrated **Cloudinary** (for media management like avatars and post image) and **Flowbite** (for UI components).
    
*   **Frontend Magic:** Utilizes **Alpine.js** for improved loading states and enhancing the user experience in authentication and profile management forms.
    

## 📦 Installation

To get a local copy up and running, follow these simple steps.

### Prerequisites

*   PHP (A recent version, e.g., 8.x)
    
*   Composer
    
*   A database (e.g., MySQL, PostgreSQL)
    
*   Node.js & npm (for frontend asset compilation)
    

### Steps

1.  **Clone the repository:**
    
    Bash
    
        git clone https://github.com/sameermandve/Logbook-Blog-App.git
        cd logbook-blog-app
    
2.  **Install PHP dependencies:**
    
    Bash
    
        composer install
    
3.  **Set up environment variables:**
    
    Bash
    
        cp .env.example .env
    
    Edit the `.env` file and configure your database and any external services (like Cloudinary).
    
4.  **Generate application key:**
    
    Bash
    
        php artisan key:generate
    
5.  **Run migrations:**
    
    Bash
    
        php artisan migrate
    
6.  **Install and compile frontend assets:**
    
    Bash
    
        npm install
        npm run dev
    
7.  **Start the local server:**
    
    Bash
    
        php artisan serve
    

The application will be available at `http://127.0.0.1:8000`.

## ⚙️ Technologies Used

*   **Framework:** Laravel
    
*   **Frontend:** Blade Templates, Flowbite, Alpine.js
    
*   **Database:** Xampp MySQL admin
    
*   **Media Management:** Cloudinary
    

## 🤝 Contribution

If you have suggestions or want to improve this project, feel free to submit a pull request or open an issue!
