# Invoice Management System

## Overview

This project is a **Laravel-based Invoice Management System** designed to help users create, manage, and track client invoices efficiently. It includes features like partial payments, role-based access control, and dynamic invoice filtering. The project also integrates **Laravel Breeze** for authentication and **SweetAlert2** for handling user alerts.

## Table of Contents

1. [Features](#features)
2. [Installation](#installation)
   1. [Docker Setup](#docker-setup)
   2. [Manual Installation (Without Docker)](#manual-installation)
3. [Registering a User for Local Development](#registering-a-user-for-local-development)
4. [Usage](#usage)
5. [Technologies Used](#technologies-used)
6. [Screenshots](#screenshots)
7. [Project Structure](#project-structure)
8. [License](#license)

## Features

- **Invoice Creation and Management**: Easily create, update, and manage invoices for clients.
  ![Invoice Images](https://github.com/Aya-Sherif/Invoices_System/blob/a5315e1bab2b737ae3c4baa6aa2464f1457da832/ReadMePhotos/NewInvoice.png) ![Invoices Display](https://github.com/Aya-Sherif/Invoices_System/blob/a5315e1bab2b737ae3c4baa6aa2464f1457da832/ReadMePhotos/invoicesDisplay.png)
- **Partial Payments**: Manage partial payments and automatically update client balances.
  
- **Role-based Access Control**: Admins have full access, while sales users can only view and manage invoices.
  

<div style="display: flex; justify-content: space-between;">
  <img src="https://github.com/Aya-Sherif/Invoices_System/blob/21d162fbf5d054c921d8acd663aef6f0e0dec81c/ReadMePhotos/Screenshot%202024-10-04%20182543.png" alt="Stock View" style="width: auto; margin-right: 10px;">

  <img src="https://github.com/Aya-Sherif/Invoices_System/blob/825ebde9e95ac89fbd090f410ccb3c4d40ca76a4/ReadMePhotos/sales-Feature.png" alt="Sales Feature" style="width: 30%; margin-right: 10px;">
  
  <img src="https://github.com/Aya-Sherif/Invoices_System/blob/21d162fbf5d054c921d8acd663aef6f0e0dec81c/ReadMePhotos/accountsfeatures.png" alt="Accounts Features" style="width: 30%;">

</div>

- **AJAX Dynamic Data Fetching**: Fetch client and product details dynamically while creating or editing invoices.`
- **Print Functionality**: Print invoices with a click of a button.
<img src="https://github.com/Aya-Sherif/Invoices_System/blob/195303d6807da3dab3aa083ce8b3532f45f33681/ReadMePhotos/PrintView.png" alt="Print View" style="width: auto; height: 30%;">

## Installation

### Docker Setup

To run the application using Docker, ensure that Docker is installed on your machine and follow these steps:

1. **Clone the repository**:
   
   ```bash
   git clone https://github.com/Aya-Sherif/Invoices_System.git
   ```

2. **Navigate to the project directory**:
   
   ```bash
   cd Invoices_System
   ```

3. **Build and run the Docker container**:
   
   ```bash
   docker-compose up --build
   ```

4. **Run database migrations**:
   
   After starting the container, you need to run the migrations to set up your database. Open another terminal window and execute:
   
   ```bash
   docker exec -it <container_name> php artisan migrate
   ```
   
   Replace `<container_name>` with the actual name of your running Docker container. You can find the container name by running `docker ps`.

5. **Access the application** in your web browser at [http://localhost:8000](http://localhost:8000).

6. **Admin Access**: To access the admin panel, navigate to the `/login` page (default root is for user access).

### Manual Installation (Without Docker)

If you prefer running the application without Docker, follow these steps:

1. **Clone the Repository**:
   
   ```bash
   git clone https://github.com/Aya-Sherif/Invoices_System.git
   cd Invoices_System
   ```

2. **Install dependencies**:
   
   ```bash
   composer install
   npm install
   npm run dev
   ```

3. **Set up the environment file**:
   
   - Copy `.env.example` to `.env` and update the environment variables:
     
     ```bash
     cp .env.example .env
     ```
   
   - Configure your database, mail, and other settings in the `.env` file.

4. **Migrate the database**:
   
   ```bash
   php artisan migrate
   ```

5. **Run the application**:
   
   ```bash
   php artisan serve
   ```

## Registering a User for Local Development

In the production environment, the register page is disabled, but if you're running this project locally and need access to the admin panel, follow these steps:

1. Open the `routes/auth.php` file and **uncomment** the part that registers a user.

2. After that, go to `/register` in your browser and create your admin account by entering your email and password.

3. Once you have registered, you can log in to the admin panel by navigating to `/login`.

## Usage

- After installation, log in as an admin to have full control over the system.
- Sales, Accounts or Stock users will have restricted access to certain features.
- Use the print functionality to generate a hard copy of the invoice.

## Technologies Used

- **Laravel 11**: Backend framework powering the web application.
- **Bootstrap 3**: Front-end framework for responsive design.
- **SweetAlert2**: Handles alert and feedback for user interactions.
- **JavaScript**: Powers dynamic features such as the slideshow.

## Project Structure

- `app/Services`: Contains service classes such as `ClientService`, `ProductService`, etc.
- `app/Http/Controllers`: Manages routes and core logic of the application.
- `resources/views`: Contains Blade templates for the frontend design.
- `database/migrations`: Handles database schema migration (without seeders).

## Screenshots

Here are some screenshots of the application:

![Products](https://github.com/Aya-Sherif/Invoices_System/blob/825ebde9e95ac89fbd090f410ccb3c4d40ca76a4/ReadMePhotos/Products.png)
![Add Product](https://github.com/Aya-Sherif/Invoices_System/blob/825ebde9e95ac89fbd090f410ccb3c4d40ca76a4/ReadMePhotos/addProduct.png)
![User Messages](https://github.com/Aya-Sherif/Invoices_System/blob/825ebde9e95ac89fbd090f410ccb3c4d40ca76a4/ReadMePhotos/messages.png)
## Contributing

If you would like to contribute to this project, please fork the repository and submit a pull request with your changes.

## License

This project is open-source under the MIT license.
