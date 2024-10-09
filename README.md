
# COVID Vaccine Registration System

This project is a Laravel-based COVID vaccine registration system designed to fulfill the requirements of the coding test. The system allows users to register for vaccination, assigns them to a vaccine center, schedules a vaccination date based on availability, and notifies them via email before their scheduled vaccination. It also provides a search feature for users to check their registration and vaccination status using their NID.

## Features
- User registration with vaccine center selection.
- Vaccine centers have a daily limit on the number of users they can serve.
- Users are scheduled based on a "first come, first serve" strategy.
- Email notifications are sent to users the night before their scheduled vaccination.
- A search page where users can check their vaccination status using their NID.
- Optimized for quick searches and fast user registration.

## Requirements
- PHP 8.0 or later
- Composer
- MySQL
- Node.js (if using a front-end like Vue or React)
- A mail server or email service provider (e.g., Mailtrap, Gmail, etc.) for email notifications

## Installation Instructions
1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/covid-vaccine-registration.git
   cd covid-vaccine-registration
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Set up environment variables:
   Copy .env.example to .env:
   ```bash
   cp .env.example .env
   ```

4. Update your .env file with the appropriate values for:
   - Database connection
   - Mail service (Mailtrap, Gmail, or another SMTP service)

5. Run database migrations:
   This will create the necessary tables and seed the database with pre-populated vaccine centers:
   ```bash
   php artisan migrate --seed
   ```
   Generate application key:
   ```bash
   php artisan key:generate
   ```
   Serve the application:
   ```bash
   php artisan serve
   ```

6. Access the application:
   Open your browser and go to http://localhost:8000

## How to Use
### Registration
- Visit the registration page at `/register`.
- Fill in your name, email, NID, and select a vaccine center.
- The system will automatically assign you a vaccination date based on center availability.
- You will receive an email the night before your vaccination date.

### Search Vaccination Status
- Visit the search page at `/search`.
- Enter your NID to check your vaccination status:
  - If not registered, the system will prompt you to register.
  - If registered but not scheduled, it will display "Not scheduled."
  - If scheduled, it will show the vaccination date.
  - If the vaccination date has passed, it will display "Vaccinated."

## Project Structure
- `UserRegistration`: Handles user data and scheduling.
- `VaccineCenter`: Stores vaccine center information and their daily limits.
- `VaccineScheduled`: A Mailable class that sends an email notification to users.
- `RegistrationController`: Manages the logic for registration and search functionalities.

## Optimizations
- Efficient querying: Used where clauses and eager loading to optimize data retrieval for both registration and search processes.
- Caching: Implement caching for search results to avoid repeated database queries, improving performance on frequent searches (can be implemented if needed).
- Queueing: For larger systems, the email notifications can be queued to offload work from the main request-response cycle, improving performance.

## Future Enhancements
### SMS Notifications
If an SMS notification feature is needed in the future, the following changes would be required:
- Integrate an SMS gateway API (such as Twilio or Nexmo) into the project.
- Update the `VaccineScheduled` class to send an SMS in addition to the email, using the selected SMS provider's API.
- Modify .env to store the necessary API keys and settings for the SMS gateway.
- Optionally, implement SMS queueing to send notifications in the background.

## Conclusion
This project demonstrates a simple yet effective system for COVID vaccine registration and scheduling. The system is designed to be extensible and efficient, with room for future improvements like SMS notifications and caching.

Thank You
