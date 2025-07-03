# SWEP-STUDENT-RECORDS
***

## Task
The Students Work Experience Programme (SWEP) requires an efficient and secure way to manage students’ records during their training period. The challenge was to build a web-based system where admins can:

- Login, create new user securely.
- Add, edit, delete, and view student records.
- Upload students in bulk via CSV for large intakes.
- Search for student records easily.
- Export students’ data for reporting.
- Ensure a clean, responsive, and user-friendly interface.

## Description
This project solves the problem by implementing a **PHP + MySQLi procedural web application** with the following features:

- **Admin authentication** (login, create new user, logout, change password)
- **Student management**
  - Add single student record
  - Edit existing record
  - Delete record
  - View records in a paginated table
  - Search records by any field
- **Bulk registration** by uploading a CSV file
- **CSV export** of all student data
- **Responsive UI** using Bootstrap 5 and Bootstrap Icons

All functionalities are protected with session-based authentication to ensure only authorized admins can manage students' records.

## Installation
1. **Clone the repository**
   ```bash
   git clone https://github.com/Saminu3110c/swep-students-records.git
   ```
   ```bash
   cd swep-students-records
   ```
2. Import the database
    -Create a database named **swep_students** in your MySQL server.
    -Import the **swep_students.sql** file into your MySQL server via phpMyAdmin or CLI:
    ```bash
    mysql -u root -p swep_students < DATABASE/swep_students.sql
    ```
3. Start XAMPP server and navigate to:
    ```bash
    http://localhost/swep-students-records
    ```

## Usage
1. Login

    - Use your credentials to log in.

    - Manage student records

    - Add, edit, or delete individual student records.

    - Upload bulk records via CSV in the Upload CSV section.

    - Export all records as CSV using the Export CSV button.

    - Create new user.

    - Change your password in the Change Password section.

### The Core Team
- Saminu Isah - isah_s

<span><i>Made at Federal University Lokoja (FUL)</i></span>
<span><img alt='Schools Logo' src='' width='20px' /></span>

