# DigitalMoneyFortune

A web-based color prediction / betting platform built with PHP, MySQL, Bootstrap, and JavaScript.

## Project Structure

```
DigitalMoneyFortune/
├── index.php                 # Home page / game interface
├── signin.php / signup.php   # Authentication pages
├── withdraw.php              # Withdrawal request page
├── header.php                # Shared header / navigation
├── adminPannel.php           # Admin dashboard
├── adminSlidebar.php         # Admin sidebar component
├── manageUsers.php           # Admin: user management
├── manageDeposits.php        # Admin: deposit management
├── manageWithdrawals.php     # Admin: withdrawal management
├── APBetsDetails.php         # Admin: AP bet details view
├── userDetails.php           # Admin: single user details
├── connection.php            # Database connection class (mysqli)
├── loop.php                  # Session/game-loop handler
├── ipn_handler.php           # Payment IPN callback handler
├── *Process.php              # Backend form/action handlers
├── server.php                # Live reload helper
├── backend/                  # Payment API logic (createPayment, createTransfer, ...)
├── src/                      # CoinPayments API library
├── css/                      # Stylesheets (Bootstrap + custom)
├── js/                       # Scripts (jQuery, Bootstrap, custom)
├── images/                   # Static images
└── *.php                     # Bundled libraries (PHPMailer, SMTP)
```

## Features

### User Side
- User registration, sign in, and password reset (email verification via SMTP)
- Color & number betting on timed game sessions with live countdown timer
- AP bet mode with detailed bet history and load-more pagination
- Wallet system with balance display
- Crypto deposit / withdrawal support (CoinPayments)

### Admin Side
- Admin panel with sidebar navigation
- Manage users: search, change username/status, adjust wallet balances
- Manage deposits & withdrawals
- Custom result control and session result processing
- View detailed AP bet records per user

## Design

- **Dark theme** — deep navy background (`#000232`) with white text for a casino-style look
- **Live countdown timer** — each betting round is time-boxed; the UI updates every second
- **Session counter** — displays current round/session number with the date
- **Responsive layout** — Bootstrap grid system; desktop sidebar collapses gracefully on mobile
- **Bold typography** — Impact-style fonts for numbers/headings to emphasize game state
- **Iconography** — Bootstrap Icons throughout navigation and actions
- **TradingView widget** — embedded market chart on the home page

## Technologies

| Layer | Technology |
|-------|------------|
| Backend | PHP (XAMPP / Apache), OOP `Database` class |
| Database | MySQL via `mysqli` |
| Frontend | HTML5, CSS3, JavaScript |
| UI Framework | Bootstrap 5 (+ Bootstrap Icons), W3.CSS |
| Libraries | jQuery |
| Email | PHPMailer (SMTP) |
| Payments | CoinPayments API (crypto), IPN callbacks |
| Charts | TradingView embedded widget |

## Getting Started

1. Clone the repo into your XAMPP `htdocs` folder (it will be placed under `htdocs/luckybet/`):
   ```
   git clone https://github.com/Akila-G05/luckybet.git
   ```
2. Import the MySQL database from [`database/DMC.sql`](database/DMC.sql) into phpMyAdmin (creates the `maruwabet` DB with all tables and seed data).
3. Update DB credentials in `connection.php` if needed.
4. Start Apache + MySQL from XAMPP and open the app in your browser:
   ```
   http://localhost/luckybet/index.php
   ```

## Note

Database credentials are currently hardcoded in `connection.php`. Move them to environment variables before deploying to production.
