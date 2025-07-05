<h3>#Life Saver</h3>

A web-based platform that bridges blood donors and recipients for timely, secure, and location-based blood donations. Built using PHP, MySQL, HTML/CSS, and hosted on InfinityFree.
🚀 Live Demo
🌍 Website: http://lifesaver.rf.gd

<h3>🔧 Features</h3>
🧑‍💻 Donor & Recipient Registration/Login

📩 Real-time email alerts to donors

🧾 Donation certificate download

🔐 Secure sessions & password hashing

👨‍⚕️ Admin Panel (Manage donors/recipients/requests)

📊 Matching based on blood group & location

🖨️ Printable certificates and responsive forms








<h3>Tech Stack</h3>

| Layer     | Technology                  |
|-----------|-----------------------------|
| Frontend  | HTML5, CSS3, JavaScript     |
| Backend   | PHP                         |
| Database  | MySQL                       |
| Hosting   | [InfinityFree](https://infinityfree.net) |
| Tools     | XAMPP, phpMyAdmin           |





ere's a step-by-step guide on how to host your Blood Donation Management System on InfinityFree for free:

🌐 Step-by-Step: Hosting with InfinityFree
🔸 1. Create an Account
Go to https://infinityfree.net

Click on “Sign Up”

Register with your email and verify it

🔸 2. Create a Hosting Account
After logging in, go to “Accounts” > click “+ Create an Account”

Choose a free subdomain (e.g., lifesaver.rf.gd)

Select a domain like .epizy.com or .rf.gd (Free subdomain)

Click Create Account

Once done, you'll see:

FTP Username

Hosting domain (e.g., lifesaver.rf.gd)

Control Panel (cPanel) Login

MySQL Database Credentials

🔸 3. Upload Project Files via File Manager
Go to File Manager from InfinityFree dashboard

Open the folder: htdocs/

⚠️ Delete the default index2.html

📁 Upload your complete project folder (e.g., blood/) or just its files into htdocs/

This includes all .php, css, images, and php/ folders

You can also use FileZilla (FTP Client) with:

Host: ftpupload.net

User: your FTP username

Password: your FTP password

🔸 4. Set Up the Database
Go to your InfinityFree Control Panel

Click "MySQL Databases"

Create a new database (e.g., if0_12345678_blood_donation)

Copy:

DB Name

DB Username

DB Password

Host (usually sqlXXX.infinityfree.com)

🔸 5. Import SQL File
Click phpMyAdmin

Choose the database you created

Go to Import tab

Select your blood_donation.sql file and click Go

Database tables will be imported

🔸 6. Update DB Connection in PHP
In php/db_connect.php, use the InfinityFree DB credentials:

php
Copy
Edit
<?php
$host = "sqlXXX.infinityfree.com";  // Replace with your actual host
$user = "if0_12345678";             // Your DB username
$pass = "your_db_password";         // Your DB password
$db   = "if0_12345678_blood_donation"; // Your full DB name

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
🔸 7. Visit Your Website
Go to: http://lifesaver.rf.gd (or your subdomain)

Your Blood Donation Management System should load!

✅ Tips for Success
Task	Tool
Upload files	InfinityFree File Manager / FileZilla
View or manage database	phpMyAdmin from cPanel
Get free domain	Use default .rf.gd, or connect custom domain
Deploy changes	Replace files via File Manager
Use SSL (HTTPS)	Enable free SSL in InfinityFree panel
Troubleshooting	Check File Manager paths and DB creds

🆘 Common Issues
403 Forbidden: Means wrong folder/file permissions or index.php missing

DB Connection Failed: Check host, username, and database name

Page Not Found: Make sure you're linking to the right .php file (index.php, donor_login.php, etc.)

Emails not working: Use a third-party SMTP service (like Gmail SMTP) if needed





<h3>Screenshots</h3>

![Screenshot 1](https://github.com/user-attachments/assets/e177ef0a-bdd7-42a6-86b9-1b317740dc85)
![Screenshot 2](https://github.com/user-attachments/assets/b2233422-0222-44b4-9230-c8129522f8ac)
![Screenshot 3](https://github.com/user-attachments/assets/eaa9a2fb-e85e-406a-9a67-862414e6d329)
![Screenshot 4](https://github.com/user-attachments/assets/8c48f837-cf1a-472b-a3e5-d486fac4202e)
![Screenshot 5](https://github.com/user-attachments/assets/66572f0f-93c7-4122-93f5-7fc5dae4d7d2)
![Screenshot 6](https://github.com/user-attachments/assets/8d55077d-f094-4c0c-b906-7fa8cd240947)
![Screenshot 7](https://github.com/user-attachments/assets/de7df759-0b96-4348-bcb0-a568808f5fea)





<h3>MIT License</h3>

Copyright (c) 2025 Ankam Srikanth


Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.



