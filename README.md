# 💇‍♂️ Men's Salon Management System (MSMS)

![Banner](MenSalon/msms/images/banner.png)

Welcome to the **Men's Salon Management System**, a comprehensive, robust, and user-friendly web application designed to streamline salon operations. Built with **PHP** and **MySQL**, this system simplifies appointment booking, service management, and customer tracking for modern barbershops and salons.

---

## 🌟 Key Features

### 👤 Customer Features
- **Modern Landing Page:** A sleek, responsive homepage showcasing salon services and branding.
- **Service Catalog:** Detailed list of available grooming services with pricing.
- **Online Appointment Booking:** Easy-to-use interface for clients to book their grooming sessions.
- **User Dashboard:** Customers can manage their profiles and track their appointment history.

### 🛠️ Admin Features
- **Dynamic Dashboard:** Real-time overview of total customers, appointments, and pending requests.
- **Service Management:** Effortlessly add, update, or remove salon services.
- **Appointment Control:** Centralized system to accept, reject, or reschedule appointments.
- **Comprehensive Reports:** Generate detailed sales and date-wise performance reports.
- **Customer Insights:** Manage the registered customer database with ease.

---

## 💻 Technology Stack

| Component | Technology |
| :--- | :--- |
| **Frontend** | HTML5, CSS3, JavaScript, Bootstrap |
| **Backend** | PHP (Core) |
| **Database** | MySQL |
| **Local Server** | XAMPP / WAMP / MAMP |

---

## ⚙️ Step-by-Step Setup Guide

Follow these steps to get the system running on your local machine:

### 1. Project Placement
Download and extract the project folder. Move the entire `men hair saloon` folder (or its contents) into your server's root directory (e.g., `C:\xampp\htdocs\` for XAMPP).

### 2. Start Services
Open your **XAMPP Control Panel** and start both **Apache** and **MySQL**.

### 3. Database Configuration
1. Open your browser and navigate to `http://localhost/phpmyadmin/`.
2. Create a new database named **`msmsdb`**.
3. Select the `msmsdb` database, click on the **Import** tab.
4. Choose the SQL file located at: `MenSalon/SQL File/msmsdb.sql` and click **Go**.

### 4. Connection Settings
Ensure the database credentials are correct in the following file:
`MenSalon/msms/includes/dbconnection.php`

### 5. Launch the Application
Access the project via your browser:
- **Client Website:** `http://localhost/men%20hair%20saloon/MenSalon/msms/index.php`
- **Admin Panel:** `http://localhost/men%20hair%20saloon/MenSalon/msms/admin/index.php`

---

## 🔑 Admin Credentials

| Role | Username | Password |
| :--- | :--- | :--- |
| **Administrator** | Abrar Akhunji | 123 |

---

## 📂 Project Structure

- `MenSalon/msms/admin/` - Admin interface and logic.
- `MenSalon/msms/includes/` - Database connection and shared components.
- `MenSalon/msms/images/` - System assets and visuals.
- `MenSalon/SQL File/` - Database schema and initial data.

---

**Developed with ❤️ by [Abrar Akhunji](https://github.com/abrar225)**

For any queries or support, feel free to reach out!
