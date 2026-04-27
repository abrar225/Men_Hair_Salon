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
├── MenSalon/
│   ├── msms/                   # Core application source code
│   │   ├── admin/              # Administrative dashboard and logic
│   │   ├── includes/           # DB connection and reusable components
│   │   ├── css/                # Custom stylesheets
│   │   ├── js/                 # Client-side scripts
│   │   ├── images/             # System assets and uploaded images
│   │   └── (Root PHP files)    # Main entry points (index, login, etc.)
│   ├── SQL File/               # Database export for import
│   └── Installation Guide.txt  # Quick start summary
└── README.md                   # Visual project overview
```

## 6. Deployment Requirements
- PHP Version: 7.4 or higher recommended.
- MySQL/MariaDB.
- Web Server: Apache (XAMPP/WAMP recommended for local development).

## 7. Developer Information
- **Project Name:** Men's Salon Management System
- **Developer:** Abrar Akhunji
- **Documentation Updated:** April 2026

---
© 2026 Abrar Akhunji Projects. All rights reserved.
