## Invoice Management System

### About

This project is a **Laravel-based Invoice Management System** designed to help users create, manage, and track client invoices efficiently. It includes features like partial payments, role-based access control, and dynamic invoice filtering. The project also integrates **Laravel Breeze** for authentication and **SweetAlert2** for handling user alerts.

### Features

- **Invoice Creation and Management**: Easily create, update, and manage invoices for clients.
- **Partial Payments**: Manage partial payments and automatically update client balances.
- **Role-based Access Control**: Admins have full access, while sales users can only view and manage invoices.
- **AJAX Dynamic Data Fetching**: Fetch client and product details dynamically while creating or editing invoices.
- **Laravel Breeze**: Provides a simple and clean authentication system.
- **SweetAlert2**: Displays interactive alerts for actions like invoice creation, deletion, etc.
- **Print Functionality**: Print invoices with a click of a button.

### Installation

1. **Clone the repository**:
   
   ```bash
[   git clone https://github.com/yourusername/invoice-management-system.git
](https://github.com/Aya-Sherif/Invoices_System.git)   cd invoice-management-system
   ```
2. **Install dependencies**:
   
   ```bash
   composer install
   npm install
   npm run dev
   ```

3. **Set up the environment file**:
   
   - Copy `.env.example` to `.env` and update the environment variables.
     
     ```bash
     cp .env.example .env
     ```
   
   - Configure your database, mail, and other settings in the `.env` file.

4. **Generate application key**:
   
   ```bash
   php artisan key:generate
   ```

5. **Migrate the database** (no seeds):
   
   ```bash
   php artisan migrate
   ```

6. **Run the application**:
   
   ```bash
   php artisan serve
   ```

### Usage

- After installation, log in as an admin to have full control over the system.
- Sales users will have restricted access to certain features.
- You can create invoices, manage client payments, and filter invoices by date and status.
- Use the print functionality to generate a hard copy of the invoice.

### Authentication

This project uses **Laravel Breeze** for authentication. You can register a user directly via the registration form or use the built-in login functionality.

### Alerts

**SweetAlert2** is used for providing user-friendly notifications and confirmations during actions like creating or deleting invoices.

### Video Demo

To see a full demo of the project, check out the video [here](#) 



### Technology Stack

- **Laravel 11**: Backend framework.
- **Bootstrap 3**: Frontend styling.
- **SweetAlert2**: User interaction alerts.
- **Laravel Breeze**: Authentication system.

### Project Structure

- `app/Services`: Contains service classes such as `ClientService`, `ProductService`, etc.
- `app/Http/Controllers`: Manages the routes and logic of the application.
- `resources/views`: Contains Blade templates for the frontend.
- `database/migrations`: Handles the database schema without seeders.

### License

This project is open-source under the MIT license.
