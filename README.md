# EventHub - Event Registration Platform

A complete event registration system with a clean HTML/CSS/JavaScript frontend and PHP backend.

## Features

### 🎯 User Management
- **User Registration** - Create new accounts with validation
- **User Login** - Secure authentication with password hashing
- **Session Management** - localStorage-based session handling
- **User Dashboard** - View personal event registrations

### 📅 Event Management
- **Event Listing** - Browse all available events
- **Event Registration** - One-click registration for events
- **Registration History** - View all registered events
- **Duplicate Prevention** - Prevent multiple registrations for same event

### 🎨 Frontend Features
- **Responsive Design** - Works on desktop, tablet, and mobile
- **Clean UI** - Modern design with Poppins font
- **Real-time Feedback** - Success/error messages for all actions
- **Dynamic Navigation** - Changes based on login status
- **Form Validation** - Client-side and server-side validation

### 🔧 Technical Features
- **PHP Backend** - RESTful API endpoints
- **MySQL Database** - Relational database with proper constraints
- **CORS Support** - Proper headers for API communication
- **Error Handling** - Comprehensive error handling throughout
- **Security** - Password hashing, SQL injection prevention

## Tech Stack

- **Frontend**: HTML5, CSS3, Vanilla JavaScript
- **Backend**: PHP 8+
- **Database**: MySQL
- **Server**: PHP Built-in Development Server
- **Styling**: Google Fonts (Poppins), Custom CSS

## Installation & Setup

### Prerequisites
- PHP 8.0 or higher
- MySQL (MAMP recommended for macOS)
- Web browser

### Database Setup
1. Start MAMP and ensure MySQL is running on port 8889
2. Create database and tables using the provided schema:
```sql
CREATE DATABASE event_registration;
-- Use the database.sql file for complete schema
```

### Configuration
1. Update database credentials in `config/config.php`:
```php
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'event_registration');
define('DB_USER', 'root');
define('DB_PASS', 'root');
```

### Running the Application
1. Start the PHP development server:
```bash
php -S 127.0.0.1:8000
```

2. Access the application at:
```
http://127.0.0.1:8000/index.html
```

## Project Structure

```
event-registration-backend/
├── api/                      # PHP API endpoints
│   ├── create_event.php     # Create new events
│   ├── db.php               # Database connection
│   ├── list_events.php      # Get all events
│   ├── login.php            # User authentication
│   ├── my_registrations.php # Get user registrations
│   ├── register.php         # User registration
│   └── register_event.php   # Event registration
├── config/
│   └── config.php           # Database configuration
├── database.sql             # Database schema
├── index.html               # Landing page
├── register.html            # User registration form
├── login.html               # User login form
├── events.html              # Event listing and registration
├── my-registrations.html    # User dashboard
└── styles.css               # Application styles
```

## API Endpoints

### User Management
- `POST /api/register.php` - Create new user account
- `POST /api/login.php` - User authentication

### Event Management
- `GET /api/list_events.php` - Get all events
- `POST /api/register_event.php` - Register for an event
- `POST /api/my_registrations.php` - Get user's registrations
- `POST /api/create_event.php` - Create new event (admin)

## Database Schema

### Users Table
- `id` - Primary key
- `full_name` - User's full name
- `email` - Unique email address
- `phone` - Phone number (optional)
- `password` - Hashed password
- `role` - User role (user/admin)
- `created_at` - Registration timestamp

### Events Table
- `id` - Primary key
- `title` - Event title
- `description` - Event description
- `location` - Event location
- `event_date` - Event date and time
- `created_by` - Foreign key to users table
- `created_at` - Creation timestamp

### Registrations Table
- `id` - Primary key
- `user_id` - Foreign key to users table
- `event_id` - Foreign key to events table
- `registered_at` - Registration timestamp
- Unique constraint on (user_id, event_id)

## Usage

1. **Register**: Create a new account at `/register.html`
2. **Login**: Sign in at `/login.html`
3. **Browse Events**: View available events at `/events.html`
4. **Register for Events**: Click "Register for Event" on any event
5. **View Registrations**: Check your registrations at `/my-registrations.html`

## Security Features

- ✅ Password hashing using PHP's `password_hash()`
- ✅ SQL injection prevention with prepared statements
- ✅ Email uniqueness validation
- ✅ Duplicate registration prevention
- ✅ Input validation and sanitization
- ✅ CORS headers for API security

## Contributing

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## License

MIT License - feel free to use this project for learning and development.

---

Built with ❤️ by DevObaloluwa
