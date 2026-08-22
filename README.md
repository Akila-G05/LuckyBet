# DigitalMoneyFortune

A web-based color prediction / betting platform built with PHP, MySQL, Bootstrap, and JavaScript.

## Features

- User sign up / sign in / forgot password (email via PHPMailer SMTP)
- Wallet system: deposits, withdrawals, balance updates (with IPN handler)
- Color & number betting (AP bets) with bet history
- Admin panel: manage users, deposits, withdrawals, results, wallet balances
- Session-based game loop result handling

## Tech Stack

- **Backend:** PHP (XAMPP / Apache), MySQL (mysqli)
- **Frontend:** HTML, CSS, JavaScript, Bootstrap
- **Libraries:** PHPMailer (bundled)

## Getting Started

1. Clone the repo into your XAMPP `htdocs` folder:
   ```
   git clone https://github.com/akilagimhana2005-cmyk/DigitalMoneyFortune.git
   ```
2. Import the MySQL database (`maruwabet`) into phpMyAdmin.
3. Update DB credentials in `connection.php` if needed.
4. Start Apache + MySQL from XAMPP and open:
   ```
   http://localhost/DigitalMoneyFortune/
   ```

## Project Structure

| Path | Description |
|------|-------------|
| `index.php`, `signin.php`, `signup.php` | Public pages |
| `*Process.php` | Backend form/action handlers |
| `adminPannel.php`, `manage*.php` | Admin panel pages |
| `backend/`, `src/`, `css/`, `js/`, `images/` | Assets |
| `connection.php` | Database connection |

## Note

Database credentials are currently hardcoded in `connection.php`. Move them to environment variables before deploying to production.
