# eMentor BD - Educational Platform

eMentor BD is a comprehensive educational platform designed to facilitate online learning, course management, and knowledge sharing. The platform provides features for course enrollment, assessments, user discussions, and content management.

![Simulator Screenshot](./assets/1.jpg)  <!-- Replace this with an actual screenshot path if available -->

## 🌟 Features

### For Students
- User authentication and profile management
- Course enrollment and tracking
- Interactive assessments
- Discussion forum participation
- Access to educational media (videos, images, and written content)
- Progress tracking and certification

### For Instructors
- Course creation and management
- Assessment creation and grading
- Content upload capabilities (photos, videos, writings)
- Student progress monitoring
- Monetization opportunities

## 📁 Project Structure
```
ementor-educational-platform/
├── assets/
│   ├── css/
│   ├── fonts/
│   ├── images/
│   ├── js/
│   └── scss/
├── includes/
│   ├── includes-structure.php
│   ├── database.sql
│   └── .DS_store
├── pages/
│   ├── action_page.php      # Handle incorrect password scenarios
│   ├── assessment_page.php  # HTML assessment interface
│   ├── course.php          # Course details display
│   ├── profile.php         # User profile management
│   ├── sign_up.php         # User registration
│   ├── user_page.php       # Discussion forum
│   ├── makeMoney.php       # Monetization features
│   ├── insert.php          # Content insertion handler
│   ├── new_page.php        # Login verification
│   ├── test.php            # Course and media showcase
│   └── welcome.php         # Registration processor
├── .gitignore
├── index.php               # Main entry point
├── README.md
└── LICENSE
```

## 🚀 Getting Started

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)
- Composer (for dependency management)

### Installation

1. Clone the repository
```bash
git clone https://github.com/yourusername/ementor-bd.git
cd ementor-bd
```

2. Set up the database
```bash
mysql -u root -p < includes/database.sql
```

3. Configure your environment
- Copy `includes/config.example.php` to `includes/config.php`
- Update database credentials and other configuration settings

4. Start the development server
```bash
php -S localhost:8000
```

5. Access the application at `http://localhost:8000`

## 💻 Tech Stack

- **Frontend**: HTML5, CSS3, Bootstrap, jQuery
- **Backend**: PHP
- **Database**: MySQL
- **Additional Libraries**: 
  - AOS (Animate On Scroll)
  - Bootstrap
  - jQuery

## 📱 Key Pages and Functionality

- **Homepage**: Entry point with course listings and platform overview
- **Course Page**: Detailed course information and enrollment options
- **Assessment Page**: Interactive HTML-based assessment system
- **User Profile**: Personal dashboard with course progress and uploads
- **Discussion Forum**: Community interaction and knowledge sharing
- **Monetization**: Platform for instructors to earn from content

## 🔒 Security Features

- Session-based authentication
- Password hashing
- Form validation
- SQL injection prevention
- XSS protection

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the APACHE 2.0 - see the [LICENSE](LICENSE) file for details.

