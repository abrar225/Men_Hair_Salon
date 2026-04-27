# Technical Documentation: Men's Salon Management System (MSMS)

## 1. Introduction
The Men's Salon Management System (MSMS) is a web-based application designed to streamline the operations of a hair salon. It provides a platform for customers to book appointments online and for administrators to manage services, appointments, and customer records efficiently.

## 2. System Architecture
- **Frontend:** Built with HTML5, CSS3, and JavaScript. Bootstrap is used for a responsive and mobile-friendly layout.
- **Backend:** Developed using Core PHP (Procedural).
- **Database:** MySQL database handles all data persistence.
- **Security:** Basic session-based authentication for admin and user login.

## 3. Key Modules

### 3.1 Customer Module
- **Registration & Login:** Secure signup and login for clients.
- **Service Browsing:** View available salon services with descriptions and pricing.
- **Appointment Booking:** Real-time appointment scheduling.
- **Appointment Status:** Users can check if their appointment is pending, accepted, or rejected.

### 3.2 Administrative Module
- **Dashboard:** Overview of business metrics (Total Sales, New Appointments, Registered Customers).
- **Service Management:** CRUD (Create, Read, Update, Delete) operations for salon services.
- **Appointment Workflow:** Admin can review new appointments and update their status.
- **Reports:** Generation of detailed reports for sales and appointments within specific date ranges.
- **Customer Database:** View and search through customer profiles.
- **Page Content Management:** Edit "About Us" and "Contact Us" pages directly from the admin panel.

## 4. Database Schema
The system uses a database named `msmsdb`. Key tables include:
- `tbladmin`: Stores administrator credentials.
- `tblcustomers`: Stores user profile information.
- `tblservices`: Contains details of services offered by the salon.
- `tblappointment`: Records all booking details and statuses.
- `tblpage`: Stores content for the static pages (About/Contact).

## 5. Directory Structure
```text
shanwaz/
├── MenSalon/
│   ├── msms/                   # Source code
│   │   ├── admin/              # Admin panel files
│   │   ├── includes/           # Database connection & shared components
│   │   ├── css/                # Stylesheets
│   │   ├── js/                 # JavaScript files
│   │   ├── images/             # Image assets
│   │   └── (Main PHP files)    # index.php, appointment.php, etc.
│   ├── SQL File/               # Database SQL script
│   └── Installation Guide.txt  # Quick setup info
└── README.md                   # Hinglish project overview
```

## 6. Deployment Requirements
- PHP Version: 7.4 or higher recommended.
- MySQL/MariaDB.
- Web Server: Apache (XAMPP/WAMP recommended for local development).

## 7. Developer Information
- **Project Name:** Men's Salon Management System
- **Developer:** Madni
- **Documentation Updated:** April 2026

---
© 2026 Madni Projects. All rights reserved.
