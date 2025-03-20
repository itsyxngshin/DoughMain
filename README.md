<p align="left"><img src="Untitled20_20250304132045 1.png" width="200" alt="DoughMain Logo"></p>

# DoughMain: Guide for Project Navigation and Collaboration

## **1. Cloning the Repository**

To get started, open your terminal and run:

```sh
git clone https://github.com/itsyxngshin/DoughMain.git
cd DoughMain
```

## **2. Install Dependencies**

### **Backend (Laravel Dependencies)**

Make sure you have **PHP**, **Composer**, and **XAMPP** installed. Then, run:

```sh
composer install
```

### **Frontend (Node.js & NPM Dependencies)**

Ensure **Node.js** and **npm** are installed, then run:

```sh
npm install
```

## **3. Setup Environment Variables**

Duplicate the `.env.example` file and rename it to `.env`:

```sh
cp .env.example .env
```

Then, generate the application key:

```sh
php artisan key:generate
```

## **4. Configure Database Connection**

Start XAMPP and make sure **Apache** and **MySQL** are running.

In the `.env` file, update the following variables:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=doughmain_db
DB_USERNAME=root
DB_PASSWORD=
```

Create the database in **phpMyAdmin** or via MySQL:

```sql
CREATE DATABASE doughmain_db;
```

Then, migrate the database:

```sh
php artisan migrate --seed
```

## **5. Run the Project**

### **Start Laravel Development Server**

```sh
php artisan serve
```

### **Start Vite for Frontend Assets**

```sh
npm run dev
```

## **6. Git Workflow for Collaborators**

### **Pull the Latest Changes**

Before making changes, always pull the latest code:

```sh
git pull origin main
```

### **Create a New Branch for Your Work** 
Ensure that you will create a branch for the module you are working on

```sh
git checkout -b feature-branch
```

### **Commit and Push Changes**

```sh
git add .
git commit -m "Added new feature"
git push origin feature-branch
```

### **Conventional Commit Messages***
Please observe the following when commiting changes to Git

```sh
feat – a new feature is introduced with the changes
fix – a bug fix has occurred
chore – changes that do not relate to a fix or feature and don't modify src or test files (for example updating dependencies)
refactor – refactored code that neither fixes a bug nor adds a feature
docs – updates to documentation such as a the README or other markdown files
style – changes that do not affect the meaning of the code, likely related to code formatting such as white-space, missing semi-colons, and so on.
test – including new or correcting previous tests
perf – performance improvements
ci – continuous integration related
build – changes that affect the build system or external dependencies
revert – reverts a previous commit
```

### **Create a Pull Request (PR) on GitHub**

1. Go to the repository on GitHub.
2. Click "New Pull Request".
3. Select `feature-branch` → `main`.
4. Submit for review and approval.

---

## **7. Troubleshooting**

### **If you get a **``** error with Git:**

Run:

```sh
git config --global credential.helper store
```

Then try pushing again.

### **If **``** is missing or not working:**

Try running:

```sh
php artisan config:clear
```

### **If Vite is not loading CSS/JS properly:**

Try:

```sh
php artisan optimize:clear
npm run build
```

---

Your Laravel 11 project is now fully set up! 🎉

For any issues, reach out to the project team or check the documentation. 🚀


