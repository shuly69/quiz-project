# Quiz Project

A full-stack web application for creating, managing, and taking quizzes/surveys. Built with pure PHP and JavaScript, featuring a custom MVC architecture and RESTful API integration.

## 🚀 Features

- **User Authentication**: Secure registration and login system with password hashing
- **Quiz Management**: Create, edit, and delete quizzes with multiple questions and answer options
- **Interactive Quizzes**: Take quizzes with real-time result calculation
- **RESTful API**: Public API endpoint for retrieving random quizzes
- **Sorting & Filtering**: Sort quizzes by creation date or ID
- **Admin System**: Role-based access control with admin functionality
- **Form Validation**: Comprehensive client and server-side validation
- **Responsive Design**: Modern UI built with Bootstrap 5

## 🛠️ Technologies

### Backend
- **PHP 7.4+** - Core server-side language
- **MySQL** - Relational database management
- **PDO** - Database abstraction layer
- **Composer** - Dependency management and autoloading

### Frontend
- **JavaScript (Vanilla)** - Client-side interactivity
- **Bootstrap 5** - Responsive UI framework
- **HTML5/CSS3** - Markup and styling

### Architecture
- **Custom MVC Framework** - Self-built Model-View-Controller pattern
- **Active Record Pattern** - ORM implementation for database operations
- **Custom Routing System** - URL routing and request handling
- **Service Layer** - Reusable services (Database, View, Request, Helpers)

## 📁 Project Structure

```
quiz-project/
├── app/
│   ├── Controllers/      # Application controllers
│   │   ├── AccountController.php
│   │   ├── ApiController.php
│   │   ├── AuthController.php
│   │   ├── MainController.php
│   │   └── ...
│   ├── Models/          # Data models
│   │   ├── Test.php
│   │   └── User.php
│   ├── Views/           # Presentation layer
│   │   ├── Account.php
│   │   ├── Home.php
│   │   └── ...
│   └── Exception/       # Custom exceptions
├── assets/
│   ├── css/            # Stylesheets
│   ├── js/             # JavaScript files
│   └── img/            # Images
├── routing/            # Routing system
│   └── Route.php
├── services/           # Core services
│   ├── ActiveRecordEntity.php
│   ├── Db.php
│   ├── Request.php
│   └── View.php
├── index.php           # Application entry point
└── composer.json       # Composer configuration
```

## 🔧 Installation

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Composer
- Web server (Apache/Nginx) or PHP built-in server

### Setup Steps

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd quiz-project
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Database Configuration**
   - Create a MySQL database named `test`
   - Update database credentials in `services/Db.php`:
     ```php
     $this->db = new PDO('mysql:host=localhost;dbname=test', 'username', 'password');
     ```

4. **Database Schema**
   Create the following tables:
   ```sql
   CREATE TABLE users (
       id INT AUTO_INCREMENT PRIMARY KEY,
       email VARCHAR(255) UNIQUE NOT NULL,
       name VARCHAR(255) NOT NULL,
       password VARCHAR(255) NOT NULL,
       admin TINYINT(1) DEFAULT 0,
       dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );

   CREATE TABLE tests (
       id_test INT AUTO_INCREMENT PRIMARY KEY,
       body_test JSON NOT NULL,
       id_user INT NOT NULL,
       dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
       FOREIGN KEY (id_user) REFERENCES users(id)
   );
   ```

5. **Run the application**
   ```bash
   php -S localhost:8000
   ```
   Or configure your web server to point to the project directory.

6. **Access the application**
   - Open `http://localhost:8000` in your browser

## 📖 Usage

### User Registration
1. Navigate to the registration page
2. Fill in email, name, and password
3. System validates and creates account

### Creating a Quiz
1. Log in to your account
2. Click "New Test" to create a quiz
3. Enter quiz title, questions, and answer options
4. Mark correct answers
5. Save the quiz

### Taking a Quiz
1. Browse available quizzes in your account
2. Select answers for each question
3. Submit to see results immediately

### API Endpoint
Access random quizzes via API:
```
GET /api-test
```
Returns a random quiz in JSON format.

## 🎯 Key Features Explained

### Custom MVC Architecture
The application implements a clean separation of concerns:
- **Models**: Handle data logic and database interactions
- **Views**: Present data to users
- **Controllers**: Process requests and coordinate between models and views

### Active Record Pattern
Models extend `ActiveRecordEntity`, providing:
- Automatic CRUD operations
- Dynamic table name resolution
- Type-safe property access

### Request Validation
The `Request` service provides:
- Field validation (required, min/max length)
- Email uniqueness checking
- Password verification and hashing
- Custom validation rules for quiz answers

### Security Features
- Password hashing using `password_hash()` with bcrypt
- SQL injection prevention via PDO prepared statements
- XSS protection with `htmlspecialchars()`
- Session-based authentication

## 🚀 Future Improvements & Suggestions

### Short-term Enhancements
1. **Environment Configuration**
   - Move database credentials to `.env` file
   - Use environment variables for configuration

2. **Error Handling**
   - Implement comprehensive error logging
   - Add user-friendly error messages
   - Create error pages for different HTTP status codes

3. **Code Quality**
   - Add PHPDoc comments
   - Implement PSR-12 coding standards
   - Add unit tests with PHPUnit

### Medium-term Features
4. **Enhanced User Experience**
   - Add quiz categories and tags
   - Implement search functionality
   - Add quiz statistics and analytics
   - Create quiz sharing with unique links

5. **API Improvements**
   - Implement proper REST API with authentication
   - Add API versioning
   - Create API documentation (OpenAPI/Swagger)
   - Add rate limiting

6. **Database Optimization**
   - Add database indexes for better performance
   - Implement database migrations
   - Add soft deletes for quizzes

### Long-term Vision
7. **Advanced Features**
   - Real-time quiz taking with WebSockets
   - Quiz templates and presets
   - Export quizzes to PDF/CSV
   - Integration with third-party services

8. **Modernization**
   - Migrate to a modern PHP framework (Laravel/Symfony)
   - Implement frontend framework (React/Vue.js)
   - Add Docker containerization
   - Set up CI/CD pipeline

9. **Scalability**
   - Implement caching (Redis/Memcached)
   - Add queue system for background jobs
   - Optimize database queries
   - Consider microservices architecture

10. **Additional Functionality**
    - Multi-language support
    - Quiz timer functionality
    - Question randomization
    - Detailed quiz reports and analytics
    - Social features (comments, ratings)
    - Mobile app development

## 🤝 Contributing

This is a portfolio project, but suggestions and improvements are welcome!

## 📝 License

This project is open source and available for educational purposes.

## 👤 Author

**shuly**

---

## 💡 Portfolio Highlights

This project demonstrates:
- ✅ Understanding of MVC architecture
- ✅ Custom framework development
- ✅ Database design and ORM implementation
- ✅ RESTful API design
- ✅ Security best practices
- ✅ Clean code principles
- ✅ Full-stack development skills

Perfect for showcasing backend PHP skills, architectural thinking, and ability to build applications from scratch without relying on heavy frameworks.

