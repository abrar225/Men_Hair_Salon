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
<!-- [2024-10-16T20:49:31] docs(readme): update project documentation and overview -->
<!-- [2025-02-27T10:14:06] docs(readme): update project documentation and overview -->
<!-- [2025-03-06T18:12:50] docs(readme): update project documentation and overview -->
<!-- [2025-05-01T13:10:51] style: improve formatting and badge alignment -->
<!-- [2025-05-01T15:36:40] docs(readme): update project documentation and overview -->
<!-- [2025-05-05T18:52:23] style: improve formatting and badge alignment -->
<!-- [2025-06-08T14:51:01] docs(readme): update project documentation and overview -->
<!-- [2025-12-06T18:34:14] style: improve formatting and badge alignment -->
<!-- [2026-01-05T18:20:57] style: improve formatting and badge alignment -->
<!-- [2026-01-25T16:24:14] style: improve formatting and badge alignment -->
<!-- [2026-02-06T21:21:50] docs(readme): update project documentation and overview -->
<!-- [2026-04-24T13:55:24] style: improve formatting and badge alignment -->
<!-- [2026-05-07T17:38:58] style: improve formatting and badge alignment -->
<!-- [2026-06-23T12:08:24] style: improve formatting and badge alignment -->
<!-- [2026-06-24T22:50:53] docs(readme): update project documentation and overview -->
<!-- [2026-07-20T10:43:14] docs(readme): update project documentation and overview -->
<!-- [2026-07-28T21:32:36] style: improve formatting and badge alignment -->
