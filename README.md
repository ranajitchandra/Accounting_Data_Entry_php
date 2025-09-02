# 🏗️ Project Expense Management System  

A simple **Expense Management System** built with **PHP & MySQL**, designed to manage projects, vendors, deposits, materials, and office costs.  

🔗 **Live Demo:** [expense.infinityfree.me](http://expense.infinityfree.me/)  
🔗 **DB Relation** [https://i.ibb.co.com/xtv5Kj60/mysql-relation.png](https://i.ibb.co.com/xtv5Kj60/mysql-relation.png)  

---

## 📌 Features  
- Manage **projects** with details like name, address, and start date.  
- Track **vendors** linked to specific projects.  
- Record **costings** (expenses) associated with vendors.  
- Manage **deposits** received for projects.  
- Track **materials** and their usage in projects.  
- Log **office costs** for project-related administration.  
- Secure **user authentication** with role-based access (`root_admin` and `general`).  

---

## 🗄️ Database Structure  

### Main Entities & Relationships  
- **Project** → Central entity (linked with vendors, deposits, materials, and office costs).  
- **Vendor** → Linked to one project; can have multiple costings.  
- **Costing** → Records expenses per vendor.  
- **Deposit** → Tracks project deposits.  
- **Materials** → Tracks material usage per project.  
- **Office Cost** → Tracks project administrative expenses.  
- **User** → Independent table for authentication and roles.  
- **Dev Tool** → Standalone, not directly related to other tables.  

---

## ⚙️ Technologies Used  
- **Backend:** PHP 8.2  
- **Database:** MySQL (MariaDB)  
- **Frontend:** HTML, CSS, Bootstrap  
- **Server:** InfinityFree Hosting  

---

## 🚀 Installation Guide  

1. Clone the repository:  
   ```bash
   git clone https://github.com/ranajitchandra/Accounting_Data_Entry_php
   cd expense
   Configure database connection in db/db.php:

    -"localhost"
    -"username"
    -"password"
    -"dbname"


## Default Login

Admin

Email: rono@gmail.com

Password: 123456