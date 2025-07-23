# Ingenzi Events - Event Registration Portal

A modern, responsive event registration platform built with PHP, MySQL, HTML5, CSS3, and JavaScript. Features an interactive image slider, mobile-friendly navigation, and real-time form validation.

![Ingenzi Events](https://img.shields.io/badge/Status-Live-brightgreen)
![PHP](https://img.shields.io/badge/PHP-8.0+-blue)
![MySQL](https://img.shields.io/badge/MySQL-5.7+-orange)
![HTML5](https://img.shields.io/badge/HTML5-Valid-brightgreen)
![CSS3](https://img.shields.io/badge/CSS3-Responsive-blue)

## 🌟 Features

### ✨ Interactive Features
- **Image Slider**: Auto-rotating hero slider with 3 beautiful event-themed images
- **Mobile Menu**: Responsive hamburger menu for mobile devices
- **Live Form Feedback**: Real-time validation and loading states
- **Smooth Scrolling**: Enhanced navigation experience
- **Scroll Effects**: Dynamic header styling on scroll

### 📱 Responsive Design
- Mobile-first approach
- Tablet and desktop optimized
- Touch-friendly interactions
- Adaptive layouts

### 🔐 Admin Panel
- Secure login system
- Event registration management
- Contact message handling
- Data export capabilities

### 🎨 Modern UI/UX
- Maroon color scheme
- Professional animations
- Clean typography
- Intuitive navigation

## 🚀 Quick Start

### Prerequisites
- XAMPP, WAMP, or similar local server
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Modern web browser

### Installation

1. **Clone or Download**
   ```bash
   # If using git
   git clone https://github.com/Nshuti7/ingenzi_events.git
   cd ingenzi_events
   
   # Or download and extract to your web server directory
   ```

2. **Database Setup**
   - Start your local server (XAMPP/WAMP)
   - Open phpMyAdmin
   - Create a new database named `ingenzi_events_db`
   - Import the `database_setup.sql` file

3. **Configuration**
   - Open `index.php`, `event.php`, `admin.php`, and `contact_submit.php`
   - Update database credentials if needed:
     ```php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "ingenzi_events_db";
     ```

4. **Access the Application**
   - Navigate to `http://localhost/ingenzi_events/`
   - Admin panel: `http://localhost/ingenzi_events/admin_login.php`
   - Default admin credentials:
     - Username: `admin`
     - Password: `admin123`

## 📁 Project Structure

```
ingenzi_events/
├── index.php              # Homepage with image slider
├── event.php              # Individual event registration page
├── about.html             # About page
├── contact.html           # Contact page
├── contact_submit.php     # Contact form handler
├── admin_login.php        # Admin authentication
├── admin.php              # Admin dashboard
├── admin_logout.php       # Admin logout
├── submit.php             # Event registration handler
├── thankyou.html          # Registration confirmation
├── style.css              # Main stylesheet
├── script.js              # Interactive JavaScript
├── database_setup.sql     # Database schema
└── README.md              # This file
```

## 🎯 Interactive Features Guide

### Image Slider
The hero section features an automatic image slider with:
- **Auto-rotation**: Changes every 5 seconds
- **Manual navigation**: Click dots to jump to specific slides
- **Responsive**: Adapts to different screen sizes
- **Smooth transitions**: Fade effects between slides

**Customization:**
```html
<!-- Add new slides in index.php -->
<div class="slide" style="background-image: url('your-image-url');">
    <div class="slide-content">
        <h2>Your Title</h2>
        <p>Your description</p>
    </div>
</div>

<!-- Add corresponding dot -->
<div class="slider-dot"></div>
```

### Mobile Menu
The hamburger menu provides:
- **Touch-friendly**: Large touch targets
- **Smooth animations**: Slide-in from left
- **Auto-close**: Closes when clicking links
- **Accessible**: Keyboard navigation support

### Form Validation
All forms include:
- **Real-time validation**: Immediate feedback
- **Visual indicators**: Error styling
- **Loading states**: "Submitting..." feedback
- **Error messages**: Clear, helpful text

## 🎨 Customization

### Colors
The primary color scheme uses maroon (`#800000`). To change colors:

```css
/* In style.css */
:root {
    --primary-color: #800000;
    --primary-hover: #a00000;
    --secondary-color: #6c757d;
}
```

### Images
Replace slider images in `index.php`:
```html
<div class="slide" style="background-image: url('your-new-image.jpg');">
```

### Content
- Update event information in the database
- Modify text content in HTML files
- Customize admin panel features

## 🔧 Technical Details

### JavaScript Features
- **Form validation**: Email, phone, and required field validation
- **Image slider**: Auto-rotation with manual controls
- **Mobile menu**: Touch-friendly navigation
- **Smooth scrolling**: Enhanced user experience
- **Scroll effects**: Dynamic header styling

### CSS Features
- **Flexbox/Grid**: Modern layout techniques
- **CSS animations**: Smooth transitions
- **Media queries**: Responsive breakpoints
- **Custom properties**: Maintainable styling

### PHP Features
- **PDO**: Secure database connections
- **Session management**: Admin authentication
- **Input validation**: Server-side security
- **Error handling**: Graceful error management

## 📱 Responsive Breakpoints

- **Mobile**: < 768px
- **Tablet**: 768px - 1024px
- **Desktop**: > 1024px

## 🔒 Security Features

- **SQL injection prevention**: Prepared statements
- **XSS protection**: HTML escaping
- **Session security**: Admin authentication
- **Input validation**: Client and server-side

## 🚀 Deployment

### Local Development
1. Use XAMPP/WAMP for local development
2. Ensure PHP and MySQL are running
3. Access via `http://localhost/ingenzi_events/`

### Production Deployment
1. Upload files to web server
2. Configure database connection
3. Set proper file permissions
4. Update admin credentials
5. Enable HTTPS for security

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## 📄 License

This project is open source and available under the [MIT License](LICENSE).

## 🆘 Support

For support or questions:
- Email: info@ingenzievents.com
- Phone: +250 788 123 456
- Address: Kigali, Rwanda

## 🔄 Version History

- **v1.0.0**: Initial release with basic functionality
- **v1.1.0**: Added interactive features (slider, mobile menu, form feedback)
- **v1.2.0**: Enhanced responsive design and animations

---

**Built with ❤️ for the community** 
