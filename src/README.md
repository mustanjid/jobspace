
# JobSpace  

**JobSpace** is a job portal platform built with **Laravel 11** and **Livewire 3**. It supports advanced features such as job listings, real-time notifications with **Pusher**, and a sleek UI designed with **Tailwind CSS**.  

---

## Features  
- **Job Listings**: Post and browse jobs in one unified space.
- **Tag based filtering**: Clicking on a tag will show the attached jobs with that tag.
- **Advanced Search & Filtering**: Quickly find opportunities using keywords, categories, and status filters.  
- **Real-Time Notifications**: Admins are updated with live job alerts powered by **Pusher**.  
- **Role-Based Access Control**: Securely manage permissions for Admins, Employers, and Users.  
- **Responsive Design**: A beautiful and functional UI built with **Tailwind CSS**.  
- **File Upload Management**: Efficiently handle uploads with proper storage linking.  
- **Admin Panel**: Monitor and control listings, users, and site activity.  

---

## Requirements  
Ensure you have the following installed:  
- **PHP** >= 8.2  
- **Composer**  
- **Node.js** >= 18.x (for Vite)  
- **MySQL** or any compatible database  

---

## Installation  

### Clone the Repository  
```bash  
git clone https://github.com/mustanjid/jobspace.git  
cd jobspace  
```  

### Install Dependencies  
1. **PHP dependencies**:  
   ```bash  
   composer install  
   ```  

2. **JavaScript dependencies**:  
   ```bash  
   npm install  
   ```  

### Environment Setup  
1. Duplicate the `.env.example` file and rename it to `.env`:  
   ```bash  
   cp .env.example .env  
   ```  
2. Update the `.env` file with your:  
   - Database credentials  
   - Pusher credentials for real-time notifications  

### Generate Application Key  
```bash  
php artisan key:generate  
```  

### Run Migrations and Seeders  
Set up the database schema and seed initial data:  
```bash  
php artisan migrate --seed  
```  

### Create Storage Link  
Ensure proper access to uploaded files by creating a symbolic link:  
```bash  
php artisan storage:link  
```  

---

## Usage  

### Run the Development Server  
1. Start the Laravel development server:  
   ```bash  
   php artisan serve  
   ```  
2. Start Vite for frontend development:  
   ```bash  
   npm run dev  
   ```  
3. Access the application at `http://127.0.0.1:8000`.  

---

## Deployment  
For production, follow these additional steps:  
1. Build frontend assets:  
   ```bash  
   npm run build  
   ```  
2. Configure your web server (e.g., Nginx or Apache).  
3. Run the following commands to optimize the application:  
   ```bash  
   php artisan optimize  
   ```  

---

## Contribution  
Contributions are welcome! Feel free to fork the repository and submit a pull request with your changes.  

---
